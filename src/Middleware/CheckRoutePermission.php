<?php

namespace LR\Route\Permissions\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;

class CheckRoutePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // $ignored = ['modal', 'ajax', 'datatable', 'store', 'show', 'update', 'generated::'];
        $ignored = config('crp.ignore',[]);
        
        $routeName = request()->route()->getName();
        if (empty($routeName)) return $next($request);

        foreach ($ignored as $ignored_word) {
            if (\Str::of($routeName)->matchAll("/$ignored_word\$/")->count()==1) return $next($request);
        }

        return $next($request);
        $user = Auth::user();
        if ($user->hasPermissionTo($routeName)) {
            // dd($routeName);
            return $next($request);
        }
        return abort(403);
        // return redirect('/')->with('fail', 'You don\'t have permisssion!!!'.$routeName);
        // return $next($request);
    }
}
