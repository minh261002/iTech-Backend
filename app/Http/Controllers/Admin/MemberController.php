<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\MemberRepositoryInterface;
use App\Services\Interfaces\MemberServiceInterface;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    protected $repository;
    protected $service;

    public function __construct(
        MemberRepositoryInterface $repository,
        MemberServiceInterface $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index()
    {
        return response()->json([
            'message' => 'MemberController@index'
        ]);
    }
}