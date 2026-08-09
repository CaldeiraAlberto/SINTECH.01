<?php
namespace App\Http\Controllers;
use App\Models\Software;
use App\Models\Installation; // <--- Importado o Model Installation
use Illuminate\Http\Request;
class SoftwareController extends Controller
{
    /**
     * Lista os softwares atribuídos ao responsável logado (Meus Softwares).
     */
    public function mySoftwares(Request $request)
    {
        $user = auth()->user();
        $pesquisa = $request->input('pesquisa');
        $installations = Installation::with(['computer', 'software'])
            ->where(function ($query) use ($user) {
                $query->where('responsavel_id', $user->id)
                      ->orWhereHas('computer', function ($q) use ($user) {
                          $q->where('responsavel_id', $user->id);
                      });
            })
            ->when($pesquisa, function ($q) use ($pesquisa) {
                $q->whereHas('software', function ($s) use ($pesquisa) {
                    $s->where('nome', 'ILIKE', "%{$pesquisa}%")
                      ->orWhere('fabricante', 'ILIKE', "%{$pesquisa}%");
                });
            })
            ->latest('data_instalacao')
            ->paginate(10)
            ->withQueryString();
        return view('softwares.my_softwares', compact('installations', 'pesquisa'));
    }
    /**
     * Lista todos os softwares.
     */
    public function index(Request $request)
    {
        $pesquisa = $request->input('pesquisa');
        /*
        |--------------------------------------------------------------------------
        | Colunas permitidas para ordenação
        |--------------------------------------------------------------------------
        */
        $colunasPermitidas = [
            'nome',
            'versao',
            'fabricante',
            'tipo',
            'estado',
            'created_at',
        ];
        $ordem = in_array(
            $request->input('ordem'),
            $colunasPermitidas
        )
            ? $request->input('ordem')
            : 'nome';
        /*
        |--------------------------------------------------------------------------
        | Consulta
        |--------------------------------------------------------------------------
        */
        $softwares = Software::query()
            ->when($pesquisa, function ($query) use ($pesquisa) {
                $query->where(function ($q) use ($pesquisa) {
                    $q->where('nome', 'ILIKE', "%{$pesquisa}%")
                        ->orWhere('versao', 'ILIKE', "%{$pesquisa}%")
                        ->orWhere('fabricante', 'ILIKE', "%{$pesquisa}%")
                        ->orWhere('tipo', 'ILIKE', "%{$pesquisa}%")
                        ->orWhere('estado', 'ILIKE', "%{$pesquisa}%");
                });
            })
            ->orderBy($ordem)
            ->paginate(10)
            ->withQueryString();
        return view('softwares.index', compact(
            'softwares',
            'pesquisa',
            'ordem'
        ));
    }
    /**
     * Formulário de cadastro.
     */
    public function create()
    {
        return view('softwares.create');
    }
    /**
     * Guarda um novo software.
     */
    public function store(Request $request)
    {
        $dadosValidados = $request->validate([
            'nome' => 'required|string|max:150',
            'versao' => 'required|string|max:50',
            'fabricante' => 'required|string|max:150',
            'licenca' => 'nullable|string|max:150',
            'tipo' => 'required|in:Sistema Operativo,Aplicação,Antivírus,Driver,Utilitário',
            'estado' => 'required|in:Ativo,Expirado,Descontinuado',
            'observacoes' => 'nullable|string',
        ]);
        Software::create($dadosValidados);
        return redirect()
            ->route('softwares.index')
            ->with('success', 'Software registado com sucesso.');
    }
    /**
     * Formulário de edição.
     */
    public function edit($id)
    {
        $software = Software::findOrFail($id);
        return view('softwares.edit', compact('software'));
    }
    /**
     * Atualiza um software.
     */
    public function update(Request $request, $id)
    {
        $software = Software::findOrFail($id);
        $dadosValidados = $request->validate([
            'nome' => 'required|string|max:150',
            'versao' => 'required|string|max:50',
            'fabricante' => 'required|string|max:150',
            'licenca' => 'nullable|string|max:150',
            'tipo' => 'required|in:Sistema Operativo,Aplicação,Antivírus,Driver,Utilitário',
            'estado' => 'required|in:Ativo,Expirado,Descontinuado',
            'observacoes' => 'nullable|string',
        ]);
        $software->update($dadosValidados);
        return redirect()
            ->route('softwares.index')
            ->with('success', 'Software atualizado com sucesso.');
    }
    /**
     * Elimina um software.
     */
    public function destroy($id)
    {
        $software = Software::findOrFail($id);
        $software->delete();
        return redirect()
            ->route('softwares.index')
            ->with('success', 'Software eliminado com sucesso.');
    }
}