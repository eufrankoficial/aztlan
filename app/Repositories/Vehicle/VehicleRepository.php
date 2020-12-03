<?php


namespace App\Repositories\Vehicle;

use App\Models\Vehicle;
use \App\Repositories\BaseRepository;

class VehicleRepository extends BaseRepository
{
    protected $modelClass = Vehicle::class;
}
