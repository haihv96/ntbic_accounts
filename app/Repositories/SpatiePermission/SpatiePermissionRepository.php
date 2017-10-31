<?php

namespace App\Repositories\SpatiePermission;

use App\Repositories\BaseRepository;
use Spatie\Permission\Models\Permission;

class SpatiePermissionRepository extends BaseRepository implements SpatiePermissionInterface
{
    public function __construct(Permission $spatiePermission)
    {
        parent::__construct($spatiePermission);
    }
}
