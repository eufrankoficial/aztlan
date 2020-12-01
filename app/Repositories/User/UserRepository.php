<?php


namespace App\Repositories\User;

use App\Models\User;
use \App\Repositories\BaseRepository;

class UserRepository extends BaseRepository
{
    protected $modelClass = User::class;
}
