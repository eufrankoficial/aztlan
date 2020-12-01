<?php

namespace App\Services\Interfaces;

use App\Models\User;
use Illuminate\Http\Request;

interface BaseServiceInterface
{
    function list(Request $request);
    function create(array $data);
    function update(array $data, User $user);
    function delete(User $user);
    function show(User $user);
}
