<?php

namespace App\Services\Interfaces;
use Illuminate\Http\Request;

interface PostCatalogueServiceInterface
{
    public function create(Request $request);

    public function update(Request $request, $id);
}