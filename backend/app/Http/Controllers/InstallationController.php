<?php
namespace App\Http\Controllers;
use App\Models\Installation;
use App\Models\Computer;
use App\Models\Software;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
class InstallationController extends Controller
{
    /**
     * Lista os softwares do responsável autenticado (Meus Softwares).
     */
    public function meusSoftwares(Request $request)
    {
        $user = auth()->user();
        $pesquisa = $request->input('pesquisa');
        $installations = Installation::with([
                'computer',
                'software',
                'responsavel',
            ])
            ->where(function ($query) use ($user) {
                // Busca instalações onde ele é o responsável OU o responsável do computador
                $query->where('responsavel_id', $user->id)
                      ->orWhereHas('computer', function ($q) use ($user) {
                          $q->where('responsavel_id', $user->id);
                      });
            })
            ->when($pesquisa, function ($q) use ($pesquisa) {
                $q->whereHas('software', function ($s) use ($pesquisa) {
                    $s->where('nome', 'ILIKE', "%{$pesquisa}%");
                });
            })
            ->latest('data_instalacao')
            ->paginate(10)
            ->withQueryString();
        return view(
            'softwares.my_softwares',
            compact('installations', 'pesquisa')
        );
    }
    /**
     * Lista todas as instalações.
     */
    public function index(Request $request)
    {
        $pesquisa = $request->input('pesquisa');
        $installations = Installation::with([
                'computer',
                'software',
                'responsavel',
            ])
            ->when($pesquisa, function ($query) use ($pesquisa) {
                $query->where(function ($qGroup) use ($pesquisa) {
                    /*
                    |--------------------------------------------------------------------------
                    | Pesquisa por computador
                    |--------------------------------------------------------------------------
                    */
                    $qGroup->whereHas('computer', function ($q) use ($pesquisa) {
                        $q->where(
                            'plaqueta',
                            'ILIKE',
                            "%{$pesquisa}%"
                        )
                        ->orWhere(
                            'modelo_cpu',
                            'ILIKE',
                            "%{$pesquisa}%"
                        );
                    })
                    /*
                    |--------------------------------------------------------------------------
                    | Pesquisa por responsável
                    |--------------------------------------------------------------------------
                    */
                    ->orWhereHas('responsavel', function ($q) use ($pesquisa) {
                        $q->where(
                            'name',
                            'ILIKE',
                            "%{$pesquisa}%"
                        )
                        ->orWhere(
                            'numero_cracha',
                            'ILIKE',
                            "%{$pesquisa}%"
                        );
                    })
                    /*
                    |--------------------------------------------------------------------------
                    | Pesquisa por software
                    |--------------------------------------------------------------------------
                    */
                    ->orWhereHas('software', function ($q) use ($pesquisa) {
                        $q->where(
                            'nome',
                            'ILIKE',
                            "%{$pesquisa}%"
                        );
                    })
                    /*
                    |--------------------------------------------------------------------------
                    | Pesquisa por quem instalou
                    |--------------------------------------------------------------------------
                    */
                    ->orWhere(
                        'instalado_por',
                        'ILIKE',
                        "%{$pesquisa}%"
                    )
                    /*
                    |--------------------------------------------------------------------------
                    | Pesquisa por estado
                    |--------------------------------------------------------------------------
                    */
                    ->orWhere(
                        'estado',
                        'ILIKE',
                        "%{$pesquisa}%"
                    );
                });
            })
            ->latest('data_instalacao')
            ->paginate(10)
            ->withQueryString();
        return view(
            'installations.index',
            compact(
                'installations',
                'pesquisa'
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
        | Buscar computadores
        |--------------------------------------------------------------------------
        */
        $computers = Computer::orderBy('plaqueta')
            ->get();
        /*
        |--------------------------------------------------------------------------
        | Buscar softwares
        |--------------------------------------------------------------------------
        */
        $softwares = Software::orderBy('nome')
            ->get();
        /*
        |--------------------------------------------------------------------------
        | Buscar responsáveis
        |
        | Apenas utilizadores:
        | - com role responsavel
        | - ativos
        |--------------------------------------------------------------------------
        */
        $responsaveis = User::where('role', 'responsavel')
            ->where('ativo', true)
            ->orderBy('name')
            ->get();
        return view(
            'installations.create',
            compact(
                'computers',
                'softwares',
                'responsaveis'
            )
        );
    }
    /**
     * Guarda uma nova instalação.
     */
    public function store(Request $request)
    {
        $dadosValidados = $request->validate([
            /*
            |--------------------------------------------------------------------------
            | Computador
            |--------------------------------------------------------------------------
            */
            'computer_id' => [
                'required',
                Rule::exists('computers', 'id'),
            ],
            /*
            |--------------------------------------------------------------------------
            | Responsável
            |--------------------------------------------------------------------------
            */
            'responsavel_id' => [
                'required',
                Rule::exists('users', 'id')
                    ->where(function ($query) {
                        $query
                            ->where('role', 'responsavel')
                            ->where('ativo', true);
                    }),
            ],
            /*
            |--------------------------------------------------------------------------
            | Software
            |--------------------------------------------------------------------------
            */
            'software_id' => [
                'required',
                Rule::exists('softwares', 'id'),
            ],
            /*
            |--------------------------------------------------------------------------
            | Data da instalação
            |--------------------------------------------------------------------------
            */
            'data_instalacao' => [
                'required',
                'date',
            ],
            /*
            |--------------------------------------------------------------------------
            | Quem realizou a instalação
            |--------------------------------------------------------------------------
            */
            'instalado_por' => [
                'required',
                'string',
                'max:100',
            ],
            /*
            |--------------------------------------------------------------------------
            | Estado
            |--------------------------------------------------------------------------
            */
            'estado' => [
                'required',
                'in:Instalado,Atualizado,Removido',
            ],
            /*
            |--------------------------------------------------------------------------
            | Observações
            |--------------------------------------------------------------------------
            */
            'observacoes' => [
                'nullable',
                'string',
            ],
        ]);
        /*
        |--------------------------------------------------------------------------
        | Criar instalação
        |--------------------------------------------------------------------------
        */
        Installation::create($dadosValidados);
        return redirect()
            ->route('installations.index')
            ->with(
                'success',
                'Instalação registada com sucesso.'
            );
    }
    /**
     * Formulário de edição.
     */
    public function edit($id)
    {
        /*
        |--------------------------------------------------------------------------
        | Buscar instalação
        |--------------------------------------------------------------------------
        */
        $installation = Installation::with([
            'computer',
            'software',
            'responsavel',
        ])->findOrFail($id);
        /*
        |--------------------------------------------------------------------------
        | Buscar computadores
        |--------------------------------------------------------------------------
        */
        $computers = Computer::orderBy('plaqueta')
            ->get();
        /*
        |--------------------------------------------------------------------------
        | Buscar softwares
        |--------------------------------------------------------------------------
        */
        $softwares = Software::orderBy('nome')
            ->get();
        /*
        |--------------------------------------------------------------------------
        | Buscar responsáveis ativos
        |--------------------------------------------------------------------------
        */
        $responsaveis = User::where('role', 'responsavel')
            ->where('ativo', true)
            ->orderBy('name')
            ->get();
        /*
        |--------------------------------------------------------------------------
        | Garantir que o responsável atual apareça na edição
        |
        | Mesmo que tenha sido posteriormente desativado.
        |--------------------------------------------------------------------------
        */
        if (
            $installation->responsavel &&
            !$responsaveis->contains(
                'id',
                $installation->responsavel_id
            )
        ) {
            $responsaveis->push(
                $installation->responsavel
            );
        }
        return view(
            'installations.edit',
            compact(
                'installation',
                'computers',
                'softwares',
                'responsaveis'
            )
        );
    }
    /**
     * Atualiza uma instalação.
     */
    public function update(Request $request, $id)
    {
        $installation = Installation::findOrFail($id);
        $dadosValidados = $request->validate([
            /*
            |--------------------------------------------------------------------------
            | Computador
            |--------------------------------------------------------------------------
            */
            'computer_id' => [
                'required',
                Rule::exists('computers', 'id'),
            ],
            /*
            |--------------------------------------------------------------------------
            | Responsável
            |--------------------------------------------------------------------------
            */
            'responsavel_id' => [
                'required',
                Rule::exists('users', 'id')
                    ->where(function ($query) {
                        $query
                            ->where('role', 'responsavel')
                            ->where('ativo', true);
                    }),
            ],
            /*
            |--------------------------------------------------------------------------
            | Software
            |--------------------------------------------------------------------------
            */
            'software_id' => [
                'required',
                Rule::exists('softwares', 'id'),
            ],
            /*
            |--------------------------------------------------------------------------
            | Data da instalação
            |--------------------------------------------------------------------------
            */
            'data_instalacao' => [
                'required',
                'date',
            ],
            /*
            |--------------------------------------------------------------------------
            | Quem realizou a instalação
            |--------------------------------------------------------------------------
            */
            'instalado_por' => [
                'required',
                'string',
                'max:100',
            ],
            /*
            |--------------------------------------------------------------------------
            | Estado
            |--------------------------------------------------------------------------
            */
            'estado' => [
                'required',
                'in:Instalado,Atualizado,Removido',
            ],
            /*
            |--------------------------------------------------------------------------
            | Observações
            |--------------------------------------------------------------------------
            */
            'observacoes' => [
                'nullable',
                'string',
            ],
        ]);
        /*
        |--------------------------------------------------------------------------
        | Atualizar instalação
        |--------------------------------------------------------------------------
        */
        $installation->update($dadosValidados);
        return redirect()
            ->route('installations.index')
            ->with(
                'success',
                'Instalação atualizada com sucesso.'
            );
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
            ->with(
                'success',
                'Instalação eliminada com sucesso.'
            );
    }
}
