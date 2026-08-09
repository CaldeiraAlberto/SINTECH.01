<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
class UserController extends Controller
{
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
        $ordem = in_array(
            $request->input('ordem'),
            $colunasPermitidas
        )
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
        return view('users.index', compact(
            'users',
            'pesquisa',
            'ordem'
        ));
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
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email'),
            ],
            'password' => 'required|string|min:5',
            'role' => 'required|in:helpdesk,responsavel',
        ]);
        User::create([
            'numero_cracha' => $request->numero_cracha,
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
            'ativo' => true,
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
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'role' => 'required|in:helpdesk,responsavel',
            'ativo' => 'required|boolean',
        ]);
        $user->numero_cracha = $request->numero_cracha;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->ativo = $request->ativo;
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
     * Elimina um utilizador.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()
            ->route('users.index')
            ->with('success', 'Utilizador eliminado com sucesso.');
    }
}