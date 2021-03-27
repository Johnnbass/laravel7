<?php

namespace App\Http\Middleware;

use Closure;

class AutenticacaoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $metodo_autenticacao, $perfil)
    {

        session_start();

        if (isset($_SESSION['email']) && $_SESSION['email'] != '') {
            return $next($request);
        } else {
            return redirect()->route('site.login', ['erro' => 2]);
        }

        // verifica se o usuário tem acesso à rota
        // echo $metodo_autenticacao . ' - ' . $perfil . '<br>';

        // if ($metodo_autenticacao == 'padrao') {
        //     echo 'Verificar o usuário e senha no banco de dados ' . ' - ' . $perfil . '<br>';
        // }

        // if ($metodo_autenticacao == 'ldap') {
        //     echo 'Verificar o usuário e senha no AD' . ' - ' . $perfil . '<br>';
        // }

        // if (false) {
        //     return $next($request);
        // } else {
        //     return Response('Acesso negado! Rota exige autenticação!!!');
        // }
    }
}
