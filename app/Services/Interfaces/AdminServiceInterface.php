<?php

namespace App\Services\Interfaces;

use Illuminate\Http\Request;

interface AdminServiceInterface
{
    public function create(Request $request);

    public function update(Request $request, $id);
}