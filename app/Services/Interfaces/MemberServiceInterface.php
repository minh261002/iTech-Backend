<?php

namespace App\Services\Interfaces;

use Illuminate\Http\Request;

interface MemberServiceInterface
{
    public function create(Request $request);

    public function updateStatus($id, Request $request);

    public function update(Request $request, $id);
}