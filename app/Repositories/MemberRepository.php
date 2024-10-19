<?php

namespace App\Repositories;
use App\Models\User;
use App\Repositories\Interfaces\MemberRepositoryInterface;

class MemberRepository extends BaseRepository implements MemberRepositoryInterface
{
    public function getModel()
    {
        return User::class;
    }
}
