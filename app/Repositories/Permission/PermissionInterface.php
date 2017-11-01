<?php

namespace App\Repositories\Permission;

interface PermissionInterface
{
	public function findByName($name, $source);
}
