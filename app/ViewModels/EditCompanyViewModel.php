<?php

namespace App\ViewModels;

use App\Models\Company;
use Spatie\ViewModels\ViewModel;

class EditCompanyViewModel extends ViewModel
{
    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    public function company(): Company
    {
        return $this->company;
    }
}
