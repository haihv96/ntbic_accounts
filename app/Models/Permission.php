<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    protected $table = "permissions";

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Role','role_has_permissions');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany('App\User','user_has_permissions');
    }

    public static function findInSourceByName($source, $name) {
    	return static::where('name', $name)->where('source', $source)->first();
    }
}
