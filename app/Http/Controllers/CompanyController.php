<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyStoreRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Models\Company;
use App\Repositories\Company\CompanyRepository;
use App\ViewModels\EditCompanyViewModel;
use App\ViewModels\ListCompanyViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    /**
     * @var CompanyRepository.
     */
    protected $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return (new ListCompanyViewModel($this->companyRepository))->view('company.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->companyRepository->create($request->except('_token'));

            flash(__('Saved with success'), 'success');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            flash(__('Something is not ok'), 'danger');
        }

        return redirect()->route('company.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return (new EditCompanyViewModel($company))->view('company.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyUpdateRequest $request, Company $company)
    {
        try {
            DB::beginTransaction();
            $this->companyRepository->update($company->id, $request->except('_token'));

            DB::commit();

            flash(__('Saved with success'), 'success');
        } catch (\Exception $e) {

            DB::rollBack();

            flash(__('Something is not ok'), 'danger');
        }

        return redirect()->route('company.detail', $company);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        return $company->delete();
    }
}
