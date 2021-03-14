<?php

namespace App\Repositories\Device;

use App\Models\DeviceTmp;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

class DeviceTmpRepository extends BaseRepository
{
    protected $modelClass = DeviceTmp::class;

    public function createTmpDevice(Request $request)
    {
        $dataToSave['device_code'] = $request->get('id');
        $dataToSave['data'] = $request->all();

        return $this->create($dataToSave);
    }
}
