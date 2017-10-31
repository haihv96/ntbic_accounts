<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Role;
use App\User;

class Permission extends Model
{
    protected $table = "permissions";

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role,'role_has_permissions');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User,'user_has_permissions');
    }
}
