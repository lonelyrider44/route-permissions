<?php

namespace LR\Route\Permissions\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function group_permissions(){
        return $this->hasMany(GroupPermission::class);
    }
    public function permissions(){
        return $this->hasManyThrough(Permission::class, GroupPermission::class,'group_id','id','id','permission_id');
    }

}
