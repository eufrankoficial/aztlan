<?php

namespace App\Repositories\Company;

use App\Models\Company;
use App\Repositories\BaseRepository;

class CompanyRepository extends BaseRepository
{
    protected $modelClass = Company::class;

    public function searchBy($request)
    {
        $model = $this->model();
        $model = $model->where($request->get('field'), 'like', $request->get('value').'%');

        return $model->get();
    }
}
