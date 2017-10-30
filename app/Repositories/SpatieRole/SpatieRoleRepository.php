<?php

namespace App\Repositories\SpatieRole;

use App\Repositories\BaseRepository;
use Spatie\Permission\Models\Role;;

class SpatieRoleRepository extends BaseRepository implements SpatieRoleInterface
{
    public function __construct(Role $spatieRole)
    {
        parent::__construct($spatieRole);
    }
}
