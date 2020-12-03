<?php

namespace App\Services\Vehicle;

use App\Repositories\Vehicle\VehicleRepository;
use App\Services\Interfaces\BaseServiceInterface;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;


class VehicleService implements BaseServiceInterface
{
    /**
     * @var VehicleRepository.
     */
    protected $vehicleRepository;

    public function __construct(VehicleRepository $vehicleRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
    }

    public function list(Request $request)
    {
        return $this->vehicleRepository->model()->filter($request)->paginate();
    }

    public function create(array $data)
    {
        
    }

    public function update(array $data, $user)
    {

    }

    public function delete($user)
    {

    }

    public function show($user)
    {

    }

    public function getToSelect($paginate = false): Collection
    {
        return $this->vehicleRepository->all(10, $paginate)->pluck('license_plate', 'id');
    }
}
