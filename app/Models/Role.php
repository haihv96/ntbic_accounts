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
        return $this->belongsToMany('App\Models\Permission', 'role_has_permissions');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'user_has_roles');
    }

    public static function findRole($source, $name)
    {
        return static::where('name', $name)->where('source', $source)->first();
    }

    public function getAllPermissions($source)
    {
        return $this->permissions->where('source', $source);
    }

    public function hasPermissionTo($source, $permission)
    {
        if (is_string($permission) && !$permission = Permission::findPermission($source, $permission)) {
            return false;
        }

        return $this->permissions->contains('id', $permission->id);
    }

    public function hasAnyPermissionTo($source, $names)
    {
        if (is_string($names)) {
            if (false !== strpos($names, '|')) {
                $names = $this->convertPipeToArray($names);
            } else {
                $names = [$names];
            }

        }

        return $this->permissions->where('source', $source)->whereIn('name', $names)->isNotEmpty();
    }

    public function givePermissionsTo($source, $names)
    {
        is_array($names) ?: $names = [$names];
        $permissions = Permission::where('source', $source)->whereIn('name', $names)->get();
        if ($permissions->isEmpty()) {
            return false;
        }
        try {
            $this->permissions()->saveMany($permissions);
            return $this;
        } catch (QueryException $e) {
            echo $e->getMessage();
        }
    }

    public function revokePermissionsTo($source, $names)
    {
        is_array($names) ?: $names = [$names];
        $permissions = Permission::where('source', $source)->whereIn('name', $names)->get();
        if ($permissions->isEmpty()) {
            return false;
        }
        try {
            $this->permissions()->detach($permissions);
            return $this;
        } catch (QueryException $e) {
            echo $e->getMessage();
        }
    }
}
