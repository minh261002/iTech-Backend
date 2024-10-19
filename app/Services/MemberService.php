<?php

namespace App\Services;
use App\Repositories\Interfaces\MemberRepositoryInterface;
use App\Services\Interfaces\MemberServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MemberService implements MemberServiceInterface
{
    protected $repository;

    public function __construct(
        MemberRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    public function create(Request $request)
    {
        $data = $request->validated();

        $data['payload']['image'] = $data['payload']['image'] ?? 'https://i0.wp.com/sbcf.fr/wp-content/uploads/2018/03/sbcf-default-avatar.png?ssl=1';
        $data['password'] = Hash::make($data['payload']['password']);

        if ($data['payload']['birthday']) {
            $data['payload']['birthday'] = date('Y-m-d', strtotime($data['payload']['birthday']));
        }

        $member = $this->repository->create($data['payload']);

        return $member;
    }

    public function updateStatus($id, Request $request)
    {
        $data = $request->all();

        $status = $data['status'];

        return $this->repository->update($id, ['status' => $status]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validated();

        if ($data['payload']['birthday']) {
            $data['payload']['birthday'] = date('Y-m-d', strtotime($data['payload']['birthday']));
        }

        if (isset($data['payload']['password'])) {
            $data['payload']['password'] = Hash::make($data['payload']['password']);
        }else{
            unset($data['payload']['password']);
        }

        return $this->repository->update($id, $data['payload']);
    }
}