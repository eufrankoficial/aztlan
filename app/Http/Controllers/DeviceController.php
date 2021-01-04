<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Services\Device\DeviceService;
use App\Services\Vehicle\VehicleService;
use App\ViewModels\CreateDeviceViewModel;
use App\ViewModels\DeviceDetailViewModel;
use Illuminate\Http\Request;
use App\ViewModels\DeviceListViewModel;
use Illuminate\Support\Facades\DB;

class DeviceController extends Controller
{
    /**
     * @var DeviceService.
     */
    protected $deviceService;

    protected $vehicleService;

    public function __construct(DeviceService $deviceService, VehicleService $vehicleService)
    {
        $this->deviceService = $deviceService;
        $this->vehicleService = $vehicleService;
    }

    public function index()
    {
        return (new DeviceListViewModel($this->deviceService))->view('device.index');
    }

    public function create()
    {
        return (new CreateDeviceViewModel($this->vehicleService))->view('device.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $device = $this->deviceService->create($request->except('_token'));

            DB::commit();
            return response()->json(['status' => true, 'url' => route('device.detail', $device->public_id)]);
        } catch(\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false]);
        }
    }

    public function show(Device $device)
    {
        return (new DeviceDetailViewModel($this->deviceService, $device))->view('device.detail');
    }

    public function edit(Device $device)
    {
        return (new DeviceDetailViewModel($this->deviceService, $device))->view('device.detail');
    }

    public function update(Request $request, Device $device)
    {
        try {
            DB::beginTransaction();

            $data = $request->except('_token');

            $this->deviceService->update($data, $device);

            DB::commit();

            return response()->json(['status' => true]);
        } catch(\Exception $e) {

            DB::rollback();
            return response()->json(['status' => false]);
        }
    }

    public function chart(Device $device)
    {
        try {

            $device = $this->deviceService->chart($device);

            $data = [
                'labels' => $device['stamps'],
                'dataSets' => $device['sets']
            ];


            response()->json(['status' => true, 'data' => $data]);
        } catch (\Exception $e) {
            return response()->json(['status' => false]);
        }
    }
}
