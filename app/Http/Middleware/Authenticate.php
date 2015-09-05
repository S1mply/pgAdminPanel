<?php

namespace App\Http\Middleware;

use Auth;
use Request;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                if(!Request::is('auth/*')){
                        return redirect()->route('login');

                }
            }
        }
        if(Request::is('auth/*') && !Auth::guest()){
            if(Request::is('auth/logout')){
                return $next($request);
            }else {
                return redirect()->route('index');
            }

        }

        return $next($request);
    }
}
