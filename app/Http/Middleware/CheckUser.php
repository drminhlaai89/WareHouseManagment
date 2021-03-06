<?php

namespace App\Http\Middleware;

use Closure;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $role = $request->session()->get('user')->role;
        if(!$role==1){
            $response= $next($request);
            return $response;
        }
        return redirect('login');
    }
    
}
