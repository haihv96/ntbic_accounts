<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Permission;
use App\Models\Role;

class User extends Authenticatable
{

    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Permission','user_has_permissions');
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Role','user_has_roles');
    }

    public function hasDirectPermissionTo($source, $permission) {
        if(is_string($permission)) {
            $permission = Permission::findPermission($source, $permission);
        }

        if (!$permission) {
            return false;
        }

        return $this->permissions->contains('id',$permission->id);
    }

    public function hasPermissionViaRole($source, $permission) {
        return $this->hasDirectPermission($source, $permission) || $this->hasPermissionViaRole($source, $permission);
    }

    public function hasPermissionTo($source, $permission) {
        return $this->hasRole($source, $permission->roles->where('source', $source));
    }

    public function givePermissionTo($source, $permission) {
        if(is_string($permission)) {
            $permission = Permission::findPermission($source, $permission);
        }

        $this->permissions()->save($permission);
        return $this;
    }

    public function revokePermissionTo($source, $permission) {
        if(is_string($permission)) {
            $permission = Permission::findPermission($source, $permission);
        }

        $this->permissions()->detach($permission);
    }

    public function hasRole($source, $roles) {
        if (is_string($roles) && false !== strpos($roles, '|')) {
            $roles = $this->convertPipeToArray($roles);
        }
        
        if(is_string($roles)) {
            $role = Role::findRole($source, $roles);
            return $this->roles->contains('id',$role->id);
        }

        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($source, $role)) {
                    return true;
                }
            }

            return false;
        }
    }

    public function assignRole($source, $role) {
        if(is_string($role)) {
            $role = Role::findRole($source, $role);
        }

        $this->roles()->save($role);
        return $this;
    }

    public function removeRole($source, $role) {
        if(is_string($role)) {
            $role = Role::findRole($source, $role);
        }

        $this->role()->detach($permission);
    }

    public function getDirectPermissions($source)
    {
        return $this->permissions->where('source',$source)->pluck('name');
    }

    public function getRoleNames($source)
    {
        return $this->roles->where('source',$source)->pluck('name');
    }

    public function getPermissionsViaRoles($source)
    {
        return $this->load('roles', 'roles.permissions')
            ->roles->where('source',$source)->flatMap(function ($role) {
                return $role->permissions;
            })->sort()->values();
    }

    public function getAllPermissions($source)
    {
        return $this->permissions->where('source',$source)
            ->merge($this->getPermissionsViaRoles($source))
            ->sort()
            ->values();
    }
}
