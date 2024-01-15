<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function Index(Request $request, $erro = null){
        switch($erro){
            case 1:
                $erro = 'Usuario ou senha nao existe!';
                break;
            case 2:
                $erro = 'Necessario realizar login para acessar a pagina';
                break;
            default:
                $erro = '';
                break;
        }

        return view('site.login', ['titulo' => 'Login', 'erro' => $erro]);
    }

    public function Cadastrar(Request $request){
        //regras de validação
        $regras = [
            'name' => 'required',
            'email' => 'email',
            'password' => 'required',
        ];

        //mensagem de feedback de validação
        $feedback = [
            'name' => 'O campo nome é obrigatório',
            'email' => 'O campo e-mail é obrigatório',
            'password' => 'O campo senha é obrigatório'
        ];

        $request->validate($regras, $feedback);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return view('site.login', ['titulo' => 'Login', 'cadastrado' => 1]);    
    }

    public function Autenticar(Request $request){

        //regras de validação
        $regras = [
            'usuario' => 'required|email',
            'password' => 'required',
        ];
        
        // Mensagem de feedback de validação
        $feedback = [
            'usuario.required' => 'O campo e-mail é obrigatório',
            'usuario.email' => 'O campo e-mail deve ser um endereço de e-mail válido',
            'password.required' => 'O campo senha é obrigatório',
        ];
 
        $request->validate($regras, $feedback);
    
        $email = $request->get('usuario');
        $password = $request->get('password');
        $user = User::where('email', $email)->first();
        if ($user && Hash::check($password, $user->password)) {
            Auth::login($user);
            return redirect()->route('app.home');
        } else {
            return redirect()->route('site.login', ['erro' => 1]);
        }
    }

public function sair()
{
    Auth::logout();
    return redirect()->route('site.login');
}
}
