<?php

namespace App\Http\Controllers;

use App\Http\Requests\FieldUpdateRequest;
use App\Models\Device;
use App\Models\Field;
use App\Repositories\System\FieldRepository;
use App\Services\Device\DeviceService;
use Illuminate\Support\Facades\DB;

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

    public function showField(Device $device)
    {
        return view('fields.index');
    }

    public function update(FieldUpdateRequest $request, Device $device, Field $field)
    {
        try {
            DB::beginTransaction();
            $data = $request->except('_token');
            $this->deviceService->updateField($data, $field);
            DB::commit();

            return response()->json(['status' => true]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false]);
        }
    }


}
