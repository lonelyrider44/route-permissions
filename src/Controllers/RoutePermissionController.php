<?php

namespace LR\Route\Permissions\Controllers;

use App\Http\Requests\StoreRoutePermissionRequest;
use App\Http\Requests\UpdateRoutePermissionRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use LR\Route\Permissions\Models\RoutePermission;
use LR\Route\Permissions\Services\RoutePermissionService;

class RoutePermissionController
{
    public $service;
    public function __construct(RoutePermissionService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $routes = $this->service->sync();
        
        return view('route_permissions::route_permission.index',compact('routes'));
    }

    


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRoutePermissionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoutePermissionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RoutePermission  $routePermission
     * @return \Illuminate\Http\Response
     */
    public function show(RoutePermission $routePermission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RoutePermission  $routePermission
     * @return \Illuminate\Http\Response
     */
    public function edit(RoutePermission $routePermission)
    {
        return view('route_permissions::route_permission.edit',compact('routePermission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRoutePermissionRequest  $request
     * @param  \App\Models\RoutePermission  $routePermission
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoutePermissionRequest $request, RoutePermission $routePermission)
    {
        $routePermission->update($request->validated());
        return redirect()->route('crp.route-permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RoutePermission  $routePermission
     * @return \Illuminate\Http\Response
     */
    public function destroy(RoutePermission $routePermission)
    {
        //
    }
}
