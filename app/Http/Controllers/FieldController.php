<?php

namespace App\Http\Controllers;

use App\Http\Requests\FieldUpdateRequest;
use App\Models\Device;
use App\Models\Field;
use App\Repositories\System\FieldRepository;
use App\Services\Device\DeviceService;

class FieldController extends Controller
{
    /**
     * @var FieldRepository.
     */
    protected $fieldRepository;

    /**
     * @var DeviceService.
     */
    protected $deviceService;

    public function __construct(FieldRepository $fieldRepository, DeviceService $deviceService)
    {
        $this->fieldRepository = $fieldRepository;
        $this->deviceService = $deviceService;
    }

    public function index()
    {
        return view('fields.index');
    }

    public function show(Device $device)
    {
        try {
            $device = $this->deviceService->getFieldsDevice($device);

            return response()->json([
                'status' => true,
                'device' => $device
            ]);

        } catch (\Exception $e) {
            return response()->json(['status' => false]);
        }
    }

    public function update(FieldUpdateRequest $request, Field $field)
    {

    }


}
