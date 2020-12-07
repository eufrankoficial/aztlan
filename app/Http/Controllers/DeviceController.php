<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Services\Device\DeviceService;
use App\Services\Vehicle\VehicleService;
use App\ViewModels\CreateDeviceViewModel;
use App\ViewModels\DeviceDetailViewModel;
use Illuminate\Http\Request;
use App\ViewModels\DeviceListViewModel;
use DB;

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return (new CreateDeviceViewModel($this->vehicleService))->view('device.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Device $device)
    {
        return (new DeviceDetailViewModel($this->deviceService, $device))->view('device.detail');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Device $device)
    {
        return (new DeviceDetailViewModel($this->deviceService, $device))->view('device.detail');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Device $device)
    {
        DB::beginTransaction();

        try {
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
