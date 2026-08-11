<?php

namespace App\Http\Controllers;

use App\Models\Retirement;
use App\Models\Computer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class RetirementController extends Controller
{
    /**
     * Lista todas as aposentações.
     */
    public function index(Request $request)
    {
        $pesquisa = $request->input('pesquisa');

        $retirements = Retirement::with([
                'computer.responsavel',
            ])
            ->when($pesquisa, function ($query) use ($pesquisa) {
                $query->where(function ($q) use ($pesquisa) {
                    $q->where('motivo', 'ILIKE', "%{$pesquisa}%")
                        ->orWhere('observacoes', 'ILIKE', "%{$pesquisa}%")
                        ->orWhereHas('computer', function ($computer) use ($pesquisa) {
                            $computer
                                ->where('plaqueta', 'ILIKE', "%{$pesquisa}%")
                                ->orWhere('modelo_cpu', 'ILIKE', "%{$pesquisa}%")
                                ->orWhereHas('responsavel', function ($responsavel) use ($pesquisa) {
                                    $responsavel
                                        ->where('name', 'ILIKE', "%{$pesquisa}%")
                                        ->orWhere('numero_cracha', 'ILIKE', "%{$pesquisa}%");
                                });
                        });
                });
            })
            ->latest('data_aposentacao')
            ->paginate(10)
            ->withQueryString();

        return view('retirements.index', compact('retirements', 'pesquisa'));
    }

    /**
     * Formulário de nova aposentação.
     */
    public function create()
    {
        // Procura apenas computadores que ainda não foram aposentados
        $computers = Computer::with('responsavel')
            ->whereDoesntHave('retirement')
            ->orderBy('plaqueta')
            ->get();

        return view('retirements.create', compact('computers'));
    }

    /**
     * Regista uma nova aposentação.
     */
    public function store(Request $request)
    {
        $dadosValidados = $request->validate([
            'computer_id' => [
                'required',
                Rule::exists(Computer::class, 'id'),
            ],
            'data_aposentacao' => [
                'required',
                'date',
            ],
            'motivo' => [
                'required',
                'string',
                'max:255',
            ],
            'observacoes' => [
                'nullable',
                'string',
            ],
        ]);

        // Verificar se o computador já está aposentado
        $jaAposentado = Retirement::where('computer_id', $dadosValidados['computer_id'])->exists();

        if ($jaAposentado) {
            return back()
                ->withInput()
                ->withErrors([
                    'computer_id' => 'Este computador já possui um registo de aposentação.',
                ]);
        }

        // Criar o registo de aposentação
        Retirement::create($dadosValidados);

        return redirect()
            ->route('retirements.index')
            ->with('success', 'Computador aposentado com sucesso.');
    }

    /**
     * Mostra os detalhes de uma aposentação.
     */
    public function show(string $id)
    {
        $retirement = Retirement::with([
            'computer.responsavel',
        ])->findOrFail($id);

        return view('retirements.show', compact('retirement'));
    }

    /**
     * Formulário de edição.
     */
    public function edit(string $id)
    {
        $retirement = Retirement::with([
            'computer.responsavel',
        ])->findOrFail($id);

        $computers = Computer::with('responsavel')
            ->where(function ($query) use ($retirement) {
                $query->whereDoesntHave('retirement')
                    ->orWhere('id', $retirement->computer_id);
            })
            ->orderBy('plaqueta')
            ->get();

        return view('retirements.edit', compact('retirement', 'computers'));
    }

    /**
     * Atualiza uma aposentação.
     */
    public function update(Request $request, string $id)
    {
        $retirement = Retirement::findOrFail($id);

        $dadosValidados = $request->validate([
            'computer_id' => [
                'required',
                Rule::exists(Computer::class, 'id'),
            ],
            'data_aposentacao' => [
                'required',
                'date',
            ],
            'motivo' => [
                'required',
                'string',
                'max:255',
            ],
            'observacoes' => [
                'nullable',
                'string',
            ],
        ]);

        $computadorDuplicado = Retirement::where('computer_id', $dadosValidados['computer_id'])
            ->where('id', '!=', $retirement->id)
            ->exists();

        if ($computadorDuplicado) {
            return back()
                ->withInput()
                ->withErrors([
                    'computer_id' => 'Este computador já possui outro registo de aposentação.',
                ]);
        }

        $retirement->update($dadosValidados);

        return redirect()
            ->route('retirements.index')
            ->with('success', 'Registo de aposentação atualizado com sucesso.');
    }

    /**
     * Elimina uma aposentação.
     */
    public function destroy(string $id)
    {
        $retirement = Retirement::findOrFail($id);
        $retirement->delete();

        return redirect()
            ->route('retirements.index')
            ->with('success', 'Registo de aposentação eliminado com sucesso.');
    }
}