<?php

namespace App;

use Doctrine\DBAL\Query\QueryException;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Permission;
use App\Models\Role;

class User extends Authenticatable
{

    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'image'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Permission', 'user_has_permissions');
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Role', 'user_has_roles');
    }

    public function getDirectPermissions($source)
    {
        return $this->permissions->where('source', $source);
    }

    public function getPermissionsViaRoles($source)
    {
        return $this->load('roles', 'roles.permissions')
            ->roles
            ->where('source', $source)
            ->flatMap(function ($role) {
                return $role->permissions;
            })->sort()->values();
    }

    public function getAllPermissions($source)
    {
        return $this->getDirectPermissions($source)
            ->merge($this->getPermissionsViaRoles($source))
            ->sort()
            ->values();
    }

    //can remove
    public function hasDirectPermission($source, $permission)
    {
        if (is_string($permission) && !$permission = Permission::findPermission($source, $permission)) {
            return false;
        }

        return $this->permissions->contains('id', $permission->id);
    }

    //can remove
    public function hasPermissionViaRole($source, $permission)
    {
        is_string($permission) ? $name = $permission : $name = $permission->name;
        return $this->getPermissionsViaRoles($source)->where('name', $name)->isNotEmpty();
    }

    //can remove
    public function hasPermissionTo($source, $permission)
    {
        return $this->hasDirectPermission($source, $permission) || $this->hasPermissionViaRole($source, $permission);
    }

    public function hasAnyPermissionsTo($source, $names)
    {
        if (is_string($names)) {
            if (false !== strpos($names, '|')) {
                $names = $this->convertPipeToArray($names);
            } else {
                $names = [$names];
            }

        }
        $directPermission = $this->permissions->where('source', $source)->whereIn('name', $names);
        $permissionViaRole = $this->getPermissionsViaRoles($source)->whereIn('name', $names);

        return $directPermission->isNotEmpty() || $permissionViaRole->isNotEmpty();
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

    public function getRoleNames($source)
    {
        return $this->roles->where('source', $source)->pluck('name');
    }

    //can remove
    public function hasRole($source, $role)
    {
        if (is_string($role) && !$role = Role::findRole($source, $role)) {
            return false;
        }

        return $this->roles->contains('id', $role->id);
    }

    public function hasAnyRoles($source, $names)
    {
        if (is_string($names)) {
            if (false !== strpos($names, '|')) {
                $names = $this->convertPipeToArray($names);
            } else {
                $names = [$names];
            }

        }

        return $this->roles->where('source', $source)->whereIn('name', $names)->isNotEmpty();
    }

    public function assignRoles($source, $names)
    {
        is_array($names) ?: $names = [$names];
        $roles = Role::where('source', $source)->whereIn('name', $names)->get();
        if ($roles->isEmpty()) {
            return false;
        }
        try {
            $this->roles()->saveMany($roles);
            return $this;
        } catch (QueryException $e) {
            echo $e->getMessage();
        }
    }

    public function removeRoles($source, $names)
    {
        is_array($names) ?: $names = [$names];
        $roles = Role::where('source', $source)->whereIn('name', $names)->get();
        if ($roles->isEmpty()) {
            return false;
        }
        try {
            $this->roles()->detach($roles);
            return $this;
        } catch (QueryException $e) {
            echo $e->getMessage();
        }
    }

    protected function convertPipeToArray(string $pipeString)
    {
        $pipeString = trim($pipeString);

        if (strlen($pipeString) <= 2) {
            return $pipeString;
        }

        $quoteCharacter = substr($pipeString, 0, 1);
        $endCharacter = substr($quoteCharacter, -1, 1);

        if ($quoteCharacter !== $endCharacter) {
            return explode('|', $pipeString);
        }

        if (!in_array($quoteCharacter, ["'", '"'])) {
            return explode('|', $pipeString);
        }

        return explode('|', trim($pipeString, $quoteCharacter));
    }
}
