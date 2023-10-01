<?php

namespace LR\Route\Permissions\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RoutePermission;
use App\Http\Requests\StoreRoutePermissionRequest;
use App\Http\Requests\UpdateRoutePermissionRequest;

class PermissionController 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('route_permissions::permission.index');
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
        //
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
        //
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
