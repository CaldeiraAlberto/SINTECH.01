<?php

namespace App\Http\Controllers;

use App\Models\Installation;
use App\Models\Computer;
use App\Models\Software;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InstallationController extends Controller
{
    /**
     * Lista os softwares do responsável autenticado (ignorando computadores aposentados).
     */
    public function meusSoftwares(Request $request)
    {
        $user = auth()->user();
        $pesquisa = $request->input('pesquisa');

        $installations = Installation::with(['computer.responsavel', 'software'])
            ->whereHas('computer', function ($q) use ($user) {
                $q->where('responsavel_id', $user->id)
                  ->whereDoesntHave('retirement'); // Esconde instalações de PCs aposentados
            })
            ->when($pesquisa, function ($q) use ($pesquisa) {
                $q->whereHas('software', function ($s) use ($pesquisa) {
                    $s->where('nome', 'ILIKE', "%{$pesquisa}%");
                });
            })
            ->latest('data_instalacao')
            ->paginate(10)
            ->withQueryString();

        return view('softwares.my_softwares', compact('installations', 'pesquisa'));
    }

    /**
     * Lista todas as instalações de computadores ativos (não aposentados).
     */
    public function index(Request $request)
    {
        $pesquisa = $request->input('pesquisa');

        $installations = Installation::with(['computer.responsavel', 'software'])
            ->whereHas('computer', function ($q) {
                $q->whereDoesntHave('retirement'); // Filtra apenas instalações de PCs não aposentados
            })
            ->when($pesquisa, function ($query) use ($pesquisa) {
                $query->where(function ($qGroup) use ($pesquisa) {
                    // Pesquisa por computador ou pelo responsável do computador
                    $qGroup->whereHas('computer', function ($q) use ($pesquisa) {
                        $q->where('plaqueta', 'ILIKE', "%{$pesquisa}%")
                          ->orWhere('modelo_cpu', 'ILIKE', "%{$pesquisa}%")
                          ->orWhereHas('responsavel', function ($res) use ($pesquisa) {
                              $res->where('name', 'ILIKE', "%{$pesquisa}%")
                                  ->orWhere('numero_cracha', 'ILIKE', "%{$pesquisa}%");
                          });
                    })
                    // Pesquisa por software
                    ->orWhereHas('software', function ($q) use ($pesquisa) {
                        $q->where('nome', 'ILIKE', "%{$pesquisa}%");
                    })
                    // Pesquisa por quem instalou ou estado
                    ->orWhere('instalado_por', 'ILIKE', "%{$pesquisa}%")
                    ->orWhere('estado', 'ILIKE', "%{$pesquisa}%");
                });
            })
            ->latest('data_instalacao')
            ->paginate(10)
            ->withQueryString();

        return view('installations.index', compact('installations', 'pesquisa'));
    }

    /**
     * Formulário de cadastro.
     */
    public function create()
    {
        // Traz apenas computadores ativos com responsável atribuído
        $computers = Computer::with('responsavel')
            ->whereNotNull('responsavel_id')
            ->whereDoesntHave('retirement') // Impede registrar novas instalações em PCs aposentados
            ->orderBy('plaqueta')
            ->get();

        $softwares = Software::orderBy('nome')->get();

        return view('installations.create', compact('computers', 'softwares'));
    }

    /**
     * Guarda uma nova instalação.
     */
    public function store(Request $request)
    {
        // 1. Valida primeiro os dados de entrada
        $dadosValidados = $request->validate([
            'computer_id' => [
                'required',
                Rule::exists(Computer::class, 'id'),
            ],
            'software_id' => [
                'required',
                Rule::exists(Software::class, 'id'),
                Rule::unique(Installation::class)->where(function ($query) use ($request) {
                    return $query->where('computer_id', $request->computer_id)
                                 ->where('estado', 'Instalado');
                }),
            ],
            'data_instalacao' => ['required', 'date'],
            'instalado_por'   => ['required', 'string', 'max:100'],
            'estado'          => ['required', 'in:Instalado,Atualizado,Removido'],
            'observacoes'      => ['nullable', 'string'],
        ]);

        // 2. Busca o computador com garantia de existência após a validação
        $computer = Computer::findOrFail($dadosValidados['computer_id']);

        // 3. Vincula automaticamente o responsável ATUAL do computador
        $dadosValidados['responsavel_id'] = $computer->responsavel_id;

        Installation::create($dadosValidados);

        return redirect()
            ->route('installations.index')
            ->with('success', 'Instalação registrada com sucesso.');
    }

    /**
     * Formulário de edição.
     */
    public function edit($id)
    {
        $installation = Installation::with(['computer.responsavel', 'software'])->findOrFail($id);

        // Mantém apenas computadores não aposentados (ou o próprio computador atual da instalação)
        $computers = Computer::with('responsavel')
            ->where(function ($q) use ($installation) {
                $q->whereDoesntHave('retirement')
                  ->orWhere('id', $installation->computer_id);
            })
            ->orderBy('plaqueta')
            ->get();

        $softwares = Software::orderBy('nome')->get();

        return view('installations.edit', compact('installation', 'computers', 'softwares'));
    }

    /**
     * Atualiza uma instalação.
     */
    public function update(Request $request, $id)
    {
        $installation = Installation::findOrFail($id);

        // 1. Valida primeiro os dados de entrada
        $dadosValidados = $request->validate([
            'computer_id' => [
                'required',
                Rule::exists(Computer::class, 'id'),
            ],
            'software_id' => [
                'required',
                Rule::exists(Software::class, 'id'),
                Rule::unique(Installation::class)->where(function ($query) use ($request) {
                    return $query->where('computer_id', $request->computer_id)
                                 ->where('estado', 'Instalado');
                })->ignore($installation->id),
            ],
            'data_instalacao' => ['required', 'date'],
            'instalado_por'   => ['required', 'string', 'max:100'],
            'estado'          => ['required', 'in:Instalado,Atualizado,Removido'],
            'observacoes'      => ['nullable', 'string'],
        ]);

        // 2. Busca o computador com garantia de existência após a validação
        $computer = Computer::findOrFail($dadosValidados['computer_id']);

        // 3. Mantém o responsável sincronizado com o dono atual do computador
        $dadosValidados['responsavel_id'] = $computer->responsavel_id;

        $installation->update($dadosValidados);

        return redirect()
            ->route('installations.index')
            ->with('success', 'Instalação atualizada com sucesso.');
    }

    /**
     * Elimina uma instalação.
     */
    public function destroy($id)
    {
        $installation = Installation::findOrFail($id);
        $installation->delete();

        return redirect()
            ->route('installations.index')
            ->with('success', 'Instalação eliminada com sucesso.');
    }
}