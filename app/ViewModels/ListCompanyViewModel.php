<?php

namespace App\ViewModels;

use App\Repositories\Company\CompanyRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\ViewModels\ViewModel;

class ListCompanyViewModel extends ViewModel
{
    /**
     * @var CompanyRepository.
     */
    protected $companyRepo;

    public function __construct(CompanyRepository $companyRepo)
    {
        $this->companyRepo = $companyRepo;
    }

    public function companies(): LengthAwarePaginator
    {
        return $this->companyRepo->model()->filter(request())->paginate();
    }
}
