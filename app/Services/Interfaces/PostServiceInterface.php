<?php

namespace App\Services\Interfaces;
use Illuminate\Http\Request;

interface PostServiceInterface
{
    public function create(Request $request);

    public function update(Request $request, $id);
}
