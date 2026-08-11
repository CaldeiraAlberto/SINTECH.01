<?php

namespace App\Http\Controllers;

use App\Models\Computer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ComputerController extends Controller
{
    /**
     * Mensagens de validação amigáveis em português.
     */
    private function messages(): array
    {
        return [
            'responsavel_id.required' => 'Por favor, selecione um responsável para o computador.',
            'responsavel_id.exists'   => 'O responsável selecionado é inválido ou não está ativo.',

            'plaqueta.required'       => 'A plaqueta / n.º de património é de preenchimento obrigatório.',
            'plaqueta.string'         => 'A plaqueta deve ser um texto válido.',
            'plaqueta.max'            => 'A plaqueta não pode ter mais de 50 caracteres.',
            'plaqueta.unique'         => 'Esta plaqueta / n.º de património já está registada no sistema.',

            'modelo_cpu.required'     => 'O modelo do processador é de preenchimento obrigatório.',
            'modelo_cpu.string'       => 'O modelo do processador deve ser um texto válido.',
            'modelo_cpu.max'          => 'O modelo do processador não pode ter mais de 100 caracteres.',

            'memoria_gb.required'     => 'A capacidade de memória RAM é obrigatória.',
            'memoria_gb.integer'      => 'A memória RAM deve ser um número inteiro.',
            'memoria_gb.min'          => 'A memória RAM deve ser de pelo menos 1 GB.',

            'data_entrada.required'   => 'A data de entrada do equipamento é obrigatória.',
            'data_entrada.date'       => 'Informe uma data de entrada válida.',
        ];
    }

    /**
     * Lista todos os computadores ativos (não aposentados).
     */
    public function index(Request $request)
    {
        $pesquisa = $request->input('pesquisa');

        $colunasPermitidas = [
            'plaqueta',
            'modelo_cpu',
            'memoria_gb',
            'data_entrada',
            'created_at',
        ];

        $ordem = in_array($request->input('ordem'), $colunasPermitidas)
            ? $request->input('ordem')
            : 'plaqueta';

        $computers = Computer::with('responsavel')
            ->whereDoesntHave('retirement')
            ->when($pesquisa, function ($query) use ($pesquisa) {
                $query->where(function ($q) use ($pesquisa) {
                    $q->where('plaqueta', 'ILIKE', "%{$pesquisa}%")
                      ->orWhere('modelo_cpu', 'ILIKE', "%{$pesquisa}%")
                      ->orWhereHas('responsavel', function ($responsavel) use ($pesquisa) {
                          $responsavel->where('name', 'ILIKE', "%{$pesquisa}%")
                                      ->orWhere('numero_cracha', 'ILIKE', "%{$pesquisa}%");
                      });
                });
            })
            ->orderBy($ordem)
            ->paginate(10)
            ->withQueryString();

        return view('computers.index', compact('computers', 'pesquisa', 'ordem'));
    }

    /**
     * Formulário de cadastro.
     */
    public function create()
    {
        // Lista apenas responsáveis que NÃO possuem computadores ATIVOS
        $responsaveis = User::query()
            ->where('role', 'responsavel')
            ->where('ativo', true)
            ->whereNotIn(
                'id',
                Computer::whereDoesntHave('retirement')
                    ->whereNotNull('responsavel_id')
                    ->pluck('responsavel_id')
            )
            ->orderBy('name')
            ->get();

        return view('computers.create', compact('responsaveis'));
    }

    /**
     * Guarda um computador.
     */
    public function store(Request $request)
    {
        $request->validate([
            'responsavel_id' => [
                'required',
                Rule::exists(User::class, 'id')->where(function ($query) {
                    $query->where('role', 'responsavel')
                          ->where('ativo', true);
                }),
                // Validação amigável no Laravel para impedir múltiplos computadores ATIVOS
                function ($attribute, $value, $fail) {
                    $possuiComputadorAtivo = Computer::where('responsavel_id', $value)
                        ->whereDoesntHave('retirement')
                        ->exists();

                    if ($possuiComputadorAtivo) {
                        $fail('Este responsável já possui um computador ativo atribuído.');
                    }
                },
            ],
            'plaqueta' => [
                'required',
                'string',
                'max:50',
                Rule::unique(Computer::class, 'plaqueta'),
            ],
            'modelo_cpu' => ['required', 'string', 'max:100'],
            'memoria_gb' => ['required', 'integer', 'min:1'],
            'data_entrada' => ['required', 'date'],
        ], $this->messages());

        Computer::create($request->only([
            'responsavel_id',
            'plaqueta',
            'modelo_cpu',
            'memoria_gb',
            'data_entrada',
        ]));

        return redirect()
            ->route('computers.index')
            ->with('success', 'Computador cadastrado com sucesso.');
    }

    /**
     * Formulário de edição.
     */
    public function edit($id)
    {
        $computer = Computer::with('responsavel')->findOrFail($id);

        $responsaveis = User::query()
            ->where('role', 'responsavel')
            ->where('ativo', true)
            ->whereNotIn(
                'id',
                Computer::whereDoesntHave('retirement')
                    ->whereNotNull('responsavel_id')
                    ->where('id', '!=', $computer->id)
                    ->pluck('responsavel_id')
            )
            ->orderBy('name')
            ->get();

        if ($computer->responsavel && !$responsaveis->contains('id', $computer->responsavel_id)) {
            $responsaveis->push($computer->responsavel);
        }

        return view('computers.edit', compact('computer', 'responsaveis'));
    }

    /**
     * Atualiza um computador e sincroniza o responsável nas suas instalações.
     */
    public function update(Request $request, $id)
    {
        $computer = Computer::findOrFail($id);

        $request->validate([
            'responsavel_id' => [
                'required',
                Rule::exists(User::class, 'id')->where(function ($query) use ($computer) {
                    $query->where('role', 'responsavel')
                          ->where(function ($q) use ($computer) {
                              $q->where('ativo', true)
                                ->orWhere('id', $computer->responsavel_id);
                          });
                }),
                function ($attribute, $value, $fail) use ($computer) {
                    $possuiComputadorAtivo = Computer::where('responsavel_id', $value)
                        ->where('id', '!=', $computer->id)
                        ->whereDoesntHave('retirement')
                        ->exists();

                    if ($possuiComputadorAtivo) {
                        $fail('Este responsável já possui um computador ativo atribuído.');
                    }
                },
            ],
            'plaqueta' => [
                'required',
                'string',
                'max:50',
                Rule::unique(Computer::class, 'plaqueta')->ignore($computer->id),
            ],
            'modelo_cpu' => ['required', 'string', 'max:100'],
            'memoria_gb' => ['required', 'integer', 'min:1'],
            'data_entrada' => ['required', 'date'],
        ], $this->messages());

        $computer->update($request->only([
            'responsavel_id',
            'plaqueta',
            'modelo_cpu',
            'memoria_gb',
            'data_entrada',
        ]));

        $computer->installations()->update([
            'responsavel_id' => $request->responsavel_id,
        ]);

        return redirect()
            ->route('computers.index')
            ->with('success', 'Computador atualizado com sucesso.');
    }

    /**
     * Elimina um computador.
     */
    public function destroy($id)
    {
        $computer = Computer::findOrFail($id);
        $computer->delete();

        return redirect()
            ->route('computers.index')
            ->with('success', 'Computador eliminado com sucesso.');
    }
}