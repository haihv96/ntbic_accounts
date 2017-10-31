<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\User;
use App\Models\Permission;

class Role extends Model
{
    protected $table = "roles";

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission,'role_has_permissions');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User,'user_has_roles');
    }
}
