<?php

namespace App\Services\Interfaces;

use Illuminate\Http\Request;

interface BaseServiceInterface
{
    function list(Request $request);
    function create(array $data);
    function update(array $data, $model);
    function delete($model);
    function show($model);
}
