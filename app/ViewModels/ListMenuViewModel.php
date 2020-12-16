<?php

namespace App\ViewModels;

use App\Repositories\System\MenuRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\ViewModels\ViewModel;

class ListMenuViewModel extends ViewModel
{
    public function __construct(MenuRepository $menuRepository)
    {
        $this->menuRepository =  $menuRepository;
    }

    /**
     * @return LengthAwarePaginator.
     */
    public function menus(): LengthAwarePaginator
    {
        return $this->menuRepository->model()->with(['parents'])->filter(request())->paginate();
    }

}
