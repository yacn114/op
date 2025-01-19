<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use App\Models\Permission as Per;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$parametr): Response
    {
        $permission = Per::where("title",$parametr)->first();
        $a = !Auth::check() || !Auth::user()->role->HasPermission($permission);
        if($a){
            abort(403);
        }else{
            null;
        }
             
        return $next($request);
    }
}
