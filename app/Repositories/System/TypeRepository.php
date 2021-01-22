<?php

namespace App\Repositories\System;

use App\Models\Type;
use App\Repositories\BaseRepository;

class TypeRepository extends BaseRepository
{
	protected $modelClass = Type::class;
}
