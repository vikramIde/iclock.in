<?php

namespace App\Http\Middleware;

use Closure;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
        public function handle($request, Closure $next, $role){
           
            if ($request->user()->role != $role){

                if($role=="collector" || $role=="admin" )
                return redirect('collection/login');    
                if($role=="collector" || $role=="admin" )
                return redirect('collection/login');    

            }

            return $next($request);
        }

}
