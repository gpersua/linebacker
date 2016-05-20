<?php

namespace linebacker\Http\Middleware;

use Closure;

class ApiAuthMiddleware
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
        //return Auth::onceBasic('key') ?: $next($request);
        $username = Input::get('email');  
        $password = Input::get('password');  
   
        $userdata = array(  
            'email' => $username,  
            'password' => $password, 
        );  
   
        $error = true;  
        $user = array();  
   
        if(Auth::attempt($userdata)) {  
            $error = false;  
            $user = array(  
                'id' => Auth::user()->id,  
                'email' => Auth::user()->email  
            );  
        }  
   
        return Response::json(array(  
            'error' => $error,  
            'user' => $user  
        ), 200)?: $next($request);  
    }  
    
}
