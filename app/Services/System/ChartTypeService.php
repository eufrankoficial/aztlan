<?php

namespace App\Services\System;

use App\Models\Device;
use App\Models\Field;
use App\Repositories\System\ChartTypeRepository;

class ChartTypeService
{
    /**
     * @var ChartTypeRepository.
     */
    protected $fieldRepo;

    public function __construct(ChartTypeRepository $chartTypeRepository)
    {
        $this->chartTypeRepository = $chartTypeRepository;
    }
}
