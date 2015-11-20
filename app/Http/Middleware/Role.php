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
                return redirect('/');  
                if($role=="admin1" || $role=="admin" )
             return redirect('/') ; 
            if($role=="admin2" || $role=="admin" )
             return redirect('/') ; 


            }

            return $next($request);
        }

}
