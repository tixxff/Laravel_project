<?php

namespace App\Http\Middleware;

use Closure;
use App\Category;
class VerifyCategory
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
        if(Category::all()->count()==0){
            Session()->flash('warning', "ต้องมีประเภทสินค้าก่อนอย่างน้อย 1 รายการ");
            return redirect("/admin/createCategory");
        }
        return $next($request);
    }
}
