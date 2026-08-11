<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Mensagens de validação personalizadas em português.
     */
    private function messages(): array
    {
        return [
            'numero_cracha.required' => 'O N.º de crachá é de preenchimento obrigatório.',
            'numero_cracha.string'   => 'O N.º de crachá deve ser um texto válido.',
            'numero_cracha.max'      => 'O N.º de crachá não pode ter mais de 30 caracteres.',
            'numero_cracha.unique'   => 'Este N.º de crachá já está registado no sistema.',

            'name.required'          => 'O nome é de preenchimento obrigatório.',
            'name.string'            => 'O nome deve ser um texto válido.',
            'name.max'               => 'O nome não pode ter mais de 255 caracteres.',

            'email.required'         => 'O e-mail é de preenchimento obrigatório.',
            'email.email'            => 'Introduza um endereço de e-mail válido.',
            'email.unique'           => 'Este e-mail já está registado no sistema.',

            'password.required'      => 'A palavra-passe é de preenchimento obrigatório.',
            'password.min'           => 'A palavra-passe deve ter pelo menos 5 caracteres.',

            'role.required'          => 'Selecione um perfil para o utilizador.',
            'role.in'                => 'O perfil selecionado é inválido.',

            'ativo.required'         => 'O estado ativo/inativo é obrigatório.',
            'ativo.boolean'          => 'O valor do estado deve ser verdadeiro ou falso.',

            'ids.required'           => 'Selecione pelo menos um utilizador para eliminar.',
            'ids.array'              => 'O formato dos dados selecionados é inválido.',
            'ids.*.exists'           => 'Um ou mais utilizadores selecionados não foram encontrados no sistema.',
        ];
    }

    /**
     * Lista todos os utilizadores.
     */
    public function index(Request $request)
    {
        $pesquisa = $request->input('pesquisa');

        $colunasPermitidas = [
            'numero_cracha',
            'name',
            'email',
            'role',
            'ativo',
            'created_at',
        ];

        $ordem = in_array($request->input('ordem'), $colunasPermitidas)
            ? $request->input('ordem')
            : 'name';

        $users = User::query()
            ->when($pesquisa, function ($query) use ($pesquisa) {
                $query->where(function ($q) use ($pesquisa) {
                    $q->where('numero_cracha', 'ILIKE', "%{$pesquisa}%")
                        ->orWhere('name', 'ILIKE', "%{$pesquisa}%")
                        ->orWhere('email', 'ILIKE', "%{$pesquisa}%");
                });
            })
            ->orderBy($ordem)
            ->paginate(10)
            ->withQueryString();

        return view('users.index', compact('users', 'pesquisa', 'ordem'));
    }

    /**
     * Mostra o formulário de cadastro.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Guarda um novo utilizador.
     */
    public function store(Request $request)
    {
        $request->validate([
            'numero_cracha' => [
                'required',
                'string',
                'max:30',
                Rule::unique('users', 'numero_cracha'),
            ],
            'name'     => 'required|string|max:255',
            'email'    => [
                'required',
                'email',
                Rule::unique('users', 'email'),
            ],
            'password' => 'required|string|min:5',
            'role'     => 'required|in:helpdesk,responsavel',
        ], $this->messages());

        User::create([
            'numero_cracha' => $request->numero_cracha,
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => $request->password,
            'role'          => $request->role,
            'ativo'         => true,
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'Utilizador criado com sucesso.');
    }

    /**
     * Mostra o formulário de edição.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Atualiza um utilizador.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'numero_cracha' => [
                'required',
                'string',
                'max:30',
                Rule::unique('users', 'numero_cracha')->ignore($user->id),
            ],
            'name'  => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'role'  => 'required|in:helpdesk,responsavel',
            'ativo' => 'required|boolean',
        ], $this->messages());

        $user->numero_cracha = $request->numero_cracha;
        $user->name          = $request->name;
        $user->email         = $request->email;
        $user->role          = $request->role;
        $user->ativo         = $request->ativo;

        if ($request->filled('password')) {
            $user->password = $request->password;
        }

        $user->save();

        return redirect()
            ->route('users.index')
            ->with('success', 'Utilizador atualizado com sucesso.');
    }

    /**
     * Alterna o estado ativo/inativo do utilizador.
     */
    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->ativo = !$user->ativo;
        $user->save();

        return redirect()
            ->route('users.index')
            ->with('success', 'Estado do utilizador atualizado com sucesso.');
    }

    /**
     * Elimina um único utilizador.
     */
    public function destroy($id)
    {
        if (auth()->id() == $id) {
            return redirect()
                ->route('users.index')
                ->with('error', 'Não pode eliminar a sua própria conta.');
        }

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'Utilizador eliminado com sucesso.');
    }

    /**
     * Elimina múltiplos utilizadores selecionados em massa.
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids'   => 'required|array',
            'ids.*' => 'exists:users,id',
        ], $this->messages());

        $ids = $request->input('ids');

        // Remove o ID do utilizador com sessão iniciada por segurança
        $ids = array_diff($ids, [auth()->id()]);

        if (empty($ids)) {
            return redirect()
                ->route('users.index')
                ->with('error', 'Não é possível eliminar a sua própria conta.');
        }

        $count = User::whereIn('id', $ids)->delete();

        return redirect()
            ->route('users.index')
            ->with('success', "{$count} utilizador(es) eliminado(s) com sucesso.");
    }
}