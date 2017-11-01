<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Permission;

class Role extends Model
{
    protected $table = "roles";

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Permission','role_has_permissions');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany('App\User','user_has_roles');
    }

    public static function findInSourceByName($source, $name) {
    	return static::where('name', $name)->where('source', $source)->first();
    }

    public function hasPermissionTo($source, $permission) {
        if(is_string($permission)) {
            $permission = Permission::findInSourceByName($source, $permission);
        }

        return $this->permissions->contains('id',$permission->id);
    }

    public function givePermissionTo($source, $permission) {
        if(is_string($permission)) {
            $permission = Permission::findInSourceByName($source, $permission);
        }

        $this->permissions()->save($permission);
        return $this;
    }

    public function revokePermissionTo($source, $permission) {
        if(is_string($permission)) {
            $permission = Permission::findInSourceByName($source, $permission);
        }

        $this->permissions()->detach($permission);
        return $this;
    }
}
