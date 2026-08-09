<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Mostra o formulário de login.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Processa o login.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => [
                'required',
                'email',
            ],

            'password' => [
                'required',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Credenciais
        |--------------------------------------------------------------------------
        */

        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'ativo' => true,
        ];

        /*
        |--------------------------------------------------------------------------
        | Autenticação
        |--------------------------------------------------------------------------
        */

        if (Auth::attempt($credentials)) {

            /*
            |--------------------------------------------------------------------------
            | Regenerar sessão
            |--------------------------------------------------------------------------
            */

            $request->session()->regenerate();

            return redirect()
                ->route('dashboard');
        }

        /*
        |--------------------------------------------------------------------------
        | Falha no login
        |--------------------------------------------------------------------------
        */

        return back()
            ->withInput($request->only('email'))
            ->with(
                'error',
                'Email ou palavra-passe inválidos.'
            );
    }

    /**
     * Termina a sessão.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('login');
    }
}