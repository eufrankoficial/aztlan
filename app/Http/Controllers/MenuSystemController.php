<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuRequestPost;
use App\Models\Menu;
use App\Repositories\System\MenuRepository;
use App\ViewModels\EditMenuViewModel;
use App\ViewModels\ListMenuViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuSystemController extends Controller
{
    /**
     * @var MenuRepository.
     */
    protected $menuRepo;

    public function __construct(MenuRepository $menuRepo)
    {
        $this->menuRepo = $menuRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return (new ListMenuViewModel($this->menuRepo))->view('menus.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return (new CreateMenuViewModel($this->menuRepo))->view('menus.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequestPost $request)
    {
        try {
            DB::beginTransaction();

            $menu = $this->menuRepo->create($request->except('_token', 'parents'));

            if($request->get('parents'))
                $this->menuRepo->saveParents($menu, $request->get('parents'));

            DB::commit();



        } catch (\Exception $e) {
            DB::rollback();
        }

        return redirect()->route('menu.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        return (new EditMenuViewModel($menu))->view('menus.detail');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequestPost $request, Menu $menu)
    {
        try {

            DB::beginTransaction();

            $menu = $this->menuRepo->update($menu->id, $request->except('_token', 'parents'));

            if(!empty($request->get('parents'))) {
                $this->menuRepo->saveParents($menu, $request->get('parents'));
            } else {
                $menu->parents()->delete();
                $menu->parent_id = 0;
                $menu->save();
            }

            DB::commit();

            return response()->json(['status' => true, 'url' => route('menu.index')]);

        } catch (\Exception $e) {
            DB::rollback();
            dd($e);

            //flash(__('Error'), 'danger');
        }

        return redirect()->route('menu.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        return $menu->delete();
    }
}
