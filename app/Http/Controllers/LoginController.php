<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
class LoginController extends Controller
{    
    /**
     * Exibe a página de login.
     *
     * @param  mixed $request Objeto da requisição HTTP.
     * @param  mixed $erro Código de erro opcional para mensagens de erro.
     *                      - 1: Usuário ou senha não existe.
     *                      - 2: Necessário realizar login para acessar a página.
     * @return void
     */
    public function Index(Request $request, $erro = null){
        switch($erro){
            case 1:
                $erro = 'Usuario ou senha inválidos!';
                break;
            case 2:
                $erro = 'Necessario realizar login para acessar a pagina';
                break;
            case 3:
                $erro = 'E-mail ja cadastrado!';
                break;
            default:
                $erro = '';
                break;
        }

        return view('site.login', ['titulo' => 'Login', 'erro' => $erro]);
    }
    
    /**
     * Processa o cadastro de um novo usuário.
     *
     * @param  mixed Request $request Objeto da requisição HTTP.
     * @return void
     */
    public function Cadastrar(Request $request){
        $ususario_existe = User::Where('email', $request->input('email'))->get();
        if($ususario_existe->isEmpty()){
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);
            return 'Cadastro realizado com sucesso';
        }else{
            return 'Email ja cadastrado!';
        }
   
    }
    
    /**
     * Autentica um usuário e redireciona para a página de home se autenticado, 
     * caso contrário, redireciona de volta para a página de login com erro.
     *
     * @param  mixed $request
     * @return void 
     */
    public function Autenticar(Request $request){

        $regras = [
            'usuario' => 'required|email',
            'password' => 'required',
        ];
        
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

    /**
     * Realiza o logout do usuário autenticado e redireciona para a página de login após o logout.
     *
     * @return void 
     */
    public function sair(){
        Auth::logout();
        return redirect()->route('site.login');
    }
}
