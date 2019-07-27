<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;


class Access
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $ops, $main = 0)
    {
        $a = User::where('id',Auth::user()->id)->whereIn('user_type', [$ops, $main])->first();
        if($a){
            return $next($request);
        }
        if ($a == 1){
            return redirect('/');
        }else
        {
            return redirect('/company');
        }

    }
}
