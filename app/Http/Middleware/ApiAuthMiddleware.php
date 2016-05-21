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
       $credentials = [
            'email' => Input::get('email'),
            'password' => Input::get('password')
        ];

        if(!Auth::attempt($credentials))
        {
            return Redirect::back()->withInput()->withErrors(['credentials' => 'We were unable to sign you in']);
        }else{
            return $next($request);
                
        }
        
  
    }
}
