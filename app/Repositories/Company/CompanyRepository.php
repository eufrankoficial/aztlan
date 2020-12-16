<?php

namespace App\Repositories\Company;

use App\Models\Company;
use App\Repositories\BaseRepository;

class CompanyRepository extends BaseRepository
{
    protected $modelClass = Company::class;
}
