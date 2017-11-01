<?php

namespace App\Repositories\Role;

use App\Repositories\BaseRepository;
use App\Models\Role;
use App\Models\Permission;

class RoleRepository extends BaseRepository implements RoleInterface
{
    public function __construct(Role $role)
    {
        parent::__construct($role);
    }
}