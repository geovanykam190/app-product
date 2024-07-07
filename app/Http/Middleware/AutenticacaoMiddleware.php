<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AutenticacaoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // return $next($request);
        // session_start();
        $value = $request->session()->get('email');

        if(isset($value) && $value != ''){
            return $next($request);
        }
        else{
            // return Response('ACESSO NEGADO, ROTA EXIGE AUTENTICACAO');
            // dd($_SESSION);
            // dd("MIDDLEWARE, VOCE NAO ESTA LOGADO");
            return redirect()->route('site.login', ['erro' => 2]);
        }
        
    }
}
