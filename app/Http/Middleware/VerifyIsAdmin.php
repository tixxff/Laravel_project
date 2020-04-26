<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class VerifyIsAdmin
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
        // ถ้าคุณเป็นadminและมีการลงชื่อเข้าใช้
        if(Auth::user()->checkIsAdmin() && Auth::check()){ 
            return $next($request);
        }
        return redirect("/login");
       
    }
}
