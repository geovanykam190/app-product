<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index(Request $request) {

        $erro = '';
        $erro = $request->get('erro');
        if ($erro == 1){
            $erro = "Usuario ou senha incorretos";
        }
        if ($erro == 2){
            $erro = "Necessario realizar login para ter acesso a pagina";
        }

        return view('site.login', ['titulo' => 'Login', 'erro' => $erro]);
    }


    public function authenticate(Request $request)
    {   
        // dd("teste");
         //regras de validacao
         $regras = [
            'email' => 'email',
            'password' => 'required'
        ];

        //definir mensagens de feedbacks de validação
        $feedback = [
            'email.email' => 'O Campo Usuario é obrigatorio',
            'password.required' => 'O Campos senha é obrigatorio'
        ];

        $request->validate($regras,$feedback);

        $email = $request->get('email');
        // dd($email);
        $password = $request->get('password');
        // dd($password);

        $user = new User();
        // dd($user);
        $usuario = $user->where('email', $email)
                    ->where('password', $password)
                    ->first();
        // dd($usuario->name);
        if(isset($usuario->name)){
            // dd("logou");
            // $request->session()->regenerate();

            // $request->session()->put('nome', $usuario->name);
            $request->session()->put('email', $usuario->email);

            // dd($request);

 
            return redirect()->intended('dashboard');
        }else{
            // dd("NAO LOGOU");
            return redirect()->route('site.login', ['erro' => 1]);
        }
 
        
    }


    public function logout(){
        // $request->session()->forget('email');
        Session::flush();
        // $request->session()->invalidate();

        return redirect()->route('site.login');

    }
}
