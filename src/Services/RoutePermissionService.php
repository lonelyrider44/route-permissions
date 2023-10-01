<?php

namespace LR\Route\Permissions\Services;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use LR\Route\Permissions\Models\RoutePermission;
use Spatie\Permission\Models\Permission;

class RoutePermissionService{

    public function sync(){
        $route_permission_from_config = config('crp.route_permissions',[]);

        $routes = collect(Route::getRoutes()->getRoutesByName())
            ->filter(function ($route) {
                return (in_array('crp', $route->middleware()) && $this->valid_route($route->getName()));
            })
            ->map(function ($route)use($route_permission_from_config) {

                $permission_name = $route_name = $route->getName();
                $route_permission_data = $route_permission_from_config[$route_name] ?? compact('route_name','permission_name');

                $route_permission = RoutePermission::updateOrCreate($route_permission_data,['route_name'],['permission_name','permission_group','method']);

                $permission = Permission::firstOrCreate(['name' => $route_permission->permission_name,'model' => '']);


                return $route_permission;
            })->all();

        
        return RoutePermission::all();
    }

    private function valid_route($route_name)
    {
        $ignores = config('crp.ignore', [
            '.store',
            '.update',
            '.datatable',
            'template.',
            'generated::'
        ]);

        if (empty($route_name)) return false;

        foreach ($ignores as $ignore) {
            if (Str::of($route_name)->matchAll("/$ignore\$/")->count() == 1) return false;
            if (Str::of($route_name)->matchAll("/^$ignore/")->count() == 1) return false;
            // if(strpos($route_name, $ignore)!==false) return false;
        }
        return true;
    }

    public function publish($fresh = false){
        Artisan::call('optimize');
        Artisan::call('cache:clear');
        $roles_with_all_permissions = config('crp.roles_with_all_permissions', []);
        $old_permissions = [];
        if (!$fresh) {
            $old_permissions = config('crp.permissions', []);
        }
        $new_permissions = [];
        try {
            foreach(Permission::all() as $p){

                if (!$fresh) {
                    // $new_permissions[$route_name] = config("crp.permissions.$route_name",array_unique($roles_with_all_permissions));
                    $new_permissions[$p->name] = $old_permissions[$p->name] ?? $roles_with_all_permissions;
                } else {
                    // $new_permissions[$route_name] = array_unique(array_merge($roles_with_all_permissions, $old_permissions[$route_name] ?? []));
                    $new_permissions[$p->name] = array_unique($old_permissions[$p->name] ?? $roles_with_all_permissions);
                }
            }
            $route_permissions = RoutePermission::whereRaw('permission_name != route_name')->whereNotNull('permission_name')->get()
                ->reduce(function($carry, $item){
                    $carry[$item->route_name] = $item->permission_name;
                    return $carry;
                },[]);
            config([
                'crp.roles_with_all_permissions' => $roles_with_all_permissions,
                'crp.route_permissions' => $route_permissions,
                'crp.permissions' => $new_permissions,
                'crp.ignore' => config('crp.ignore', [
                    '.store',
                    '.update',
                    '.datatable',
                    'template.',
                    'generated::'
                ])
            ]);
            $fp = fopen(base_path() . '/config/crp.php', 'w');
            fwrite($fp, '<?php return ' . $this->varexport(config('crp'), true) . ';');
            fclose($fp);

            // Artisan::call('optimize');
            // Artisan::call('cache:clear');
            // $this->info('Permisije su indeksirane!');
        } catch (\Exception $e) {
            // $this->error($e->getMessage());
        }
    }

    function varexport($expression, $return = FALSE)
    {
        $export = var_export($expression, TRUE);
        $patterns = [
            "/array \(/" => '[',
            "/^([ ]*)\)(,?)$/m" => '$1]$2',
            "/=>[ ]?\n[ ]+\[/" => '=> [',
            "/([ ]*)(\'[^\']+\') => ([\[\'])/" => '$1$2 => $3',
        ];
        $export = preg_replace(array_keys($patterns), array_values($patterns), $export);

        $export = preg_replace("/[0-9]+ \=\>/i", '', $export);
        if ((bool) $return) return $export;
        else echo $export;
    }

}