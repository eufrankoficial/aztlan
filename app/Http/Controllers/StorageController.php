<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

class StorageController extends Controller
{
    public function image(Request $request)
    {
        try {
            $path = $request->query('path') ?? null;
            $width = $request->query('width') ?? null;
            $height = $request->query('height') ?? null;

            if (!is_null($path)) {
                $file = Storage::disk('s3')->get($path);
            }

            if (!isset($file)) {
                $data = $this->decodeUrl($request);
                if (!is_null($data['path'])) {
                    $file = Storage::disk('s3')->get($data['path']);
                }
            }
            $manager = new ImageManager(['driver' => 'imagick']);

            $image = $manager->make($file);

            return $image->response($image->extension);
        } catch (\Exception $e) {
            abort(404);
        }
    }

    public function decodeUrl($request)
    {
        $inputRAW = $request->getQueryString();
        $inputDECODE = htmlspecialchars_decode($inputRAW);

        $input = str_replace('height=null&', '', $inputDECODE);
        $input = str_replace('&width=null', '', $input);
        $input = str_replace('amp%3B', '', $input);

        $parametros = explode('path=', $input);

        return [
            'path' => isset($parametros[1]) ? $parametros[1] : null,
        ];
    }
}
