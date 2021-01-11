<?php

namespace App\Repositories\System;

use App\Models\Permissions;
use App\Repositories\BaseRepository;

class PermissionRepository extends BaseRepository
{
	protected $modelClass = Permissions::class;
}
