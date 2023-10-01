<?php

use LR\Route\Permissions\Controllers\GroupController;
use LR\Route\Permissions\Controllers\PermissionController;
use LR\Route\Permissions\Controllers\RoleController;
use LR\Route\Permissions\Controllers\RoutePermissionController;
use LR\Route\Permissions\Controllers\SettingsController;

Route::prefix('crp')->name('crp.')->middleware(['web','crp'])->group(function(){
    
    Route::get('roles/{role}/permissions',[RoleController::class,'show_permissions'])->name('roles.permissions');
    Route::patch('roles/{role}/permissions',[RoleController::class,'update_permissions']);
    Route::resource('roles',RoleController::class);

    // Route::get('permissions/publish',[RoutePermissionController::class,'publish'])->name('permissions.publish');
    Route::resource('permissions',PermissionController::class);
    
    Route::get('groups/autodetect',[GroupController::class,'autodetect'])->name('groups.autodetect');
    Route::get('groups/{group}/permissions',[GroupController::class,'show_permissions'])->name('groups.permissions');
    Route::patch('groups/{group}/permissions',[GroupController::class,'update_permissions']);
    Route::resource('groups', GroupController::class);
    
    // Route::get('route-permissions/publish',[RoutePermissionController::class,'publish'])->name('route-permissions.publish');
    Route::resource('route-permissions',RoutePermissionController::class);
    // Route::resource('routes',RoutePermissionController::class);


    Route::get('settings/publish',[SettingsController::class,'publish'])->name('settings.publish');
    Route::resource('settings',SettingsController::class)->only(['index','store']);
});