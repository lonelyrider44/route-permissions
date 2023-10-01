<?php

namespace LR\Route\Permissions;

use Illuminate\Support\Facades\Artisan;

class RoutePermissionsController
{


    public function index()
    {
        $this->get_routes();

    
        return view('route_permissions::index', [
            'roles' => \Spatie\Permission\Models\Role::all(),
            'permission_groups' => $this->get_permission_groups(),
            'permissions' => \Spatie\Permission\Models\Permission::all()
        ]);
        // dd('radi');
    }
    public function index2()
    {
        dd('radi');
    }


    public function get_routes()
    {
        Artisan::call('cache:clear');
        Artisan::call('config:cache');
        $ignore_route_words = collect(['store', 'update', 'datatable','generated']);
        $routes = \Illuminate\Support\Facades\Route::getRoutes();
        $rute = collect();
        foreach ($routes as $route) {
            if (!in_array('crp', $route->middleware())) continue;

            if (empty($route->getName())) continue;

            if ($ignore_route_words->filter(function ($word) use ($route) {
                return str_contains($route->getName(), $word);
            })->isNotEmpty())
                continue;

            \Spatie\Permission\Models\Permission::updateOrCreate(['name' => $route->getName()], []);
            // \Spatie\Permission\Models\Role::find(1)->givePermissionTo(
            // );
            $rute->push($route);
        }
        
    }
    public function get_permission_groups(){
        return \Spatie\Permission\Models\Permission::all()->filter(function($permission){
            return count(explode('.',$permission->name))>1;
        })->map(function($permission){
            return [
                'group' => explode('.',$permission->name)[0],
                'permission' => $permission->name
            ];
            return explode('.',$permission->name)[0];
        })->groupBy('group');
    }
    function assignArrayByPath(&$arr, $path)
    {
        $keys = explode('.', $path);

        while ($key = array_shift($keys)) {
            $arr = &$arr[$key];
        }
    }
}
