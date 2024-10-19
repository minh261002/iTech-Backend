<?php

namespace App\Services\Interfaces;

use Illuminate\Http\Request;

interface RoleServiceInterface
{
    public function create(Request $request);

    public function update(Request $request, $id);
}
