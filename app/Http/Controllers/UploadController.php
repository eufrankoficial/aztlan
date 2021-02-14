<?php

namespace App\Http\Controllers;

use App\Repositories\Company\CompanyRepository;
use App\Storage\ImageUploader;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    protected $imageUploader;

    public function __construct(ImageUploader $imageUploader, CompanyRepository $companyRepo)
    {
        $this->imageUploader = $imageUploader;
        $this->companyRepo = $companyRepo;
    }

    public function upload(Request $request)
    {
        try {
            $fileUploaded = $this->imageUploader->makeUpload($request->file('file'), $request->get('company_id'));
            $this->companyRepo->update($request->get('company_id'), [
                'logo' => $fileUploaded,
            ]);

            return response()->json([
                'status' => true,
                'image' => $fileUploaded,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => false,
            ], 500);
        }
    }
}
