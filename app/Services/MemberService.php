<?php

namespace App\Services;
use App\Repositories\Interfaces\MemberRepositoryInterface;
use App\Services\Interfaces\MemberServiceInterface;

class MemberService implements MemberServiceInterface
{
    protected $repository;

    public function __construct(
        MemberRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }
}
