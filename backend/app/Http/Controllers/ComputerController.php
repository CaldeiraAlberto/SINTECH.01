<?php

namespace App\Http\Controllers;

use App\Models\Computer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ComputerController extends Controller
{
    /**
     * Lista todos os computadores.
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
            'plaqueta',
            'modelo_cpu',
            'memoria_gb',
            'data_entrada',
            'created_at',
        ];

        $ordem = in_array(
            $request->input('ordem'),
            $colunasPermitidas
        )
            ? $request->input('ordem')
            : 'plaqueta';

        /*
        |--------------------------------------------------------------------------
        | Consulta
        |--------------------------------------------------------------------------
        */

        $computers = Computer::with('responsavel')
            ->when($pesquisa, function ($query) use ($pesquisa) {

                $query->where(function ($q) use ($pesquisa) {

                    $q->where(
                        'plaqueta',
                        'ILIKE',
                        "%{$pesquisa}%"
                    )

                    ->orWhere(
                        'modelo_cpu',
                        'ILIKE',
                        "%{$pesquisa}%"
                    )

                    ->orWhereHas(
                        'responsavel',
                        function ($responsavel) use ($pesquisa) {

                            $responsavel
                                ->where(
                                    'name',
                                    'ILIKE',
                                    "%{$pesquisa}%"
                                )

                                ->orWhere(
                                    'numero_cracha',
                                    'ILIKE',
                                    "%{$pesquisa}%"
                                );
                        }
                    );

                });
            })
            ->orderBy($ordem)
            ->paginate(10)
            ->withQueryString();

        return view(
            'computers.index',
            compact(
                'computers',
                'pesquisa',
                'ordem'
            )
        );
    }


    /**
     * Formulário de cadastro.
     */
    public function create()
    {
        /*
        |--------------------------------------------------------------------------
        | Buscar somente responsáveis ativos
        |--------------------------------------------------------------------------
        */

        $responsaveis = User::query()
            ->where('role', 'responsavel')
            ->where('ativo', true)
            ->orderBy('name')
            ->get();

        return view(
            'computers.create',
            compact('responsaveis')
        );
    }


    /**
     * Guarda um computador.
     */
    public function store(Request $request)
    {
        $request->validate([

            /*
            |--------------------------------------------------------------------------
            | Responsável
            |--------------------------------------------------------------------------
            */

            'responsavel_id' => [
                'required',

                Rule::exists(
                    'pgsql.sintech.users',
                    'id'
                )->where(function ($query) {

                    $query
                        ->where('role', 'responsavel')
                        ->where('ativo', true);

                }),
            ],


            /*
            |--------------------------------------------------------------------------
            | Plaqueta
            |--------------------------------------------------------------------------
            */

            'plaqueta' => [
                'required',
                'string',
                'max:50',

                Rule::unique(
                    'pgsql.sintech.computers',
                    'plaqueta'
                ),
            ],


            /*
            |--------------------------------------------------------------------------
            | Modelo
            |--------------------------------------------------------------------------
            */

            'modelo_cpu' => [
                'required',
                'string',
                'max:100',
            ],


            /*
            |--------------------------------------------------------------------------
            | Memória
            |--------------------------------------------------------------------------
            */

            'memoria_gb' => [
                'required',
                'integer',
                'min:1',
            ],


            /*
            |--------------------------------------------------------------------------
            | Data
            |--------------------------------------------------------------------------
            */

            'data_entrada' => [
                'required',
                'date',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Criar computador
        |--------------------------------------------------------------------------
        */

        Computer::create([

            'responsavel_id' => $request->responsavel_id,

            'plaqueta' => $request->plaqueta,

            'modelo_cpu' => $request->modelo_cpu,

            'memoria_gb' => $request->memoria_gb,

            'data_entrada' => $request->data_entrada,

        ]);


        return redirect()
            ->route('computers.index')
            ->with(
                'success',
                'Computador cadastrado com sucesso.'
            );
    }


    /**
     * Formulário de edição.
     */
    public function edit($id)
    {
        /*
        |--------------------------------------------------------------------------
        | Buscar computador
        |--------------------------------------------------------------------------
        */

        $computer = Computer::with('responsavel')
            ->findOrFail($id);


        /*
        |--------------------------------------------------------------------------
        | Buscar responsáveis ativos
        |--------------------------------------------------------------------------
        */

        $responsaveis = User::query()
            ->where('role', 'responsavel')
            ->where('ativo', true)
            ->orderBy('name')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Garantir que o responsável atual apareça
        |--------------------------------------------------------------------------
        |
        | Se o responsável foi desativado depois que o computador
        | foi cadastrado, ele continuará disponível no formulário
        | de edição.
        |
        */

        if (
            $computer->responsavel &&
            !$responsaveis->contains(
                'id',
                $computer->responsavel_id
            )
        ) {
            $responsaveis->push(
                $computer->responsavel
            );
        }


        return view(
            'computers.edit',
            compact(
                'computer',
                'responsaveis'
            )
        );
    }


    /**
     * Atualiza um computador.
     */
    public function update(
        Request $request,
        $id
    ) {
        /*
        |--------------------------------------------------------------------------
        | Buscar computador
        |--------------------------------------------------------------------------
        */

        $computer = Computer::findOrFail($id);


        /*
        |--------------------------------------------------------------------------
        | Validação
        |--------------------------------------------------------------------------
        */

        $request->validate([

            /*
            |--------------------------------------------------------------------------
            | Responsável
            |--------------------------------------------------------------------------
            */

            'responsavel_id' => [
                'required',

                Rule::exists(
                    'pgsql.sintech.users',
                    'id'
                )->where(function ($query) {

                    $query
                        ->where('role', 'responsavel')
                        ->where('ativo', true);

                }),
            ],


            /*
            |--------------------------------------------------------------------------
            | Plaqueta
            |--------------------------------------------------------------------------
            */

            'plaqueta' => [
                'required',
                'string',
                'max:50',

                Rule::unique(
                    'pgsql.sintech.computers',
                    'plaqueta'
                )->ignore($computer->id),
            ],


            /*
            |--------------------------------------------------------------------------
            | Modelo
            |--------------------------------------------------------------------------
            */

            'modelo_cpu' => [
                'required',
                'string',
                'max:100',
            ],


            /*
            |--------------------------------------------------------------------------
            | Memória
            |--------------------------------------------------------------------------
            */

            'memoria_gb' => [
                'required',
                'integer',
                'min:1',
            ],


            /*
            |--------------------------------------------------------------------------
            | Data
            |--------------------------------------------------------------------------
            */

            'data_entrada' => [
                'required',
                'date',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Atualizar computador
        |--------------------------------------------------------------------------
        */

        $computer->update([

            'responsavel_id' => $request->responsavel_id,

            'plaqueta' => $request->plaqueta,

            'modelo_cpu' => $request->modelo_cpu,

            'memoria_gb' => $request->memoria_gb,

            'data_entrada' => $request->data_entrada,

        ]);


        return redirect()
            ->route('computers.index')
            ->with(
                'success',
                'Computador atualizado com sucesso.'
            );
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
            ->with(
                'success',
                'Computador eliminado com sucesso.'
            );
    }
}