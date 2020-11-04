<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

class UserIsAuth
{
    public function handle($request, Closure $next)
    {

        if (Auth::check()) {
            return $next($request);
        }

      	return redirect()->route('login_front_end_user_view');
    }
}
