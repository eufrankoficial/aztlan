<?php

namespace App\Responses\Devices;

use App\Models\Device;
use Illuminate\Http\JsonResponse;

class DeviceDetailResponse
{

    protected $device;
    protected $json;

    public function __construct(Device $device)
    {
        $this->device = $device;
    }

    private function convert(Device $device)
    {
        $this->json = response()->json($device);

        return $this;
    }

    public function get()
    {
        $this->convert($this->device);
        return $this->json;
    }
}
