<?php

namespace App\Services;

use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Services\Interfaces\CategoryServiceInterface;
use Illuminate\Http\Request;

class CategoryService implements CategoryServiceInterface
{
    protected $data;

    protected $repository;

    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create(Request $request)
    {
        $this->data = $request->validated();
        if ($this->data['image'] == null) {
            $this->data['image'] = 'https://res.cloudinary.com/doy3slx9i/image/upload/v1729583527/itech_images/not-found_wqnrcf.jpg';
        }
        return $this->repository->create($this->data);
    }

    public function update(Request $request, $id)
    {
        $this->data = $request->validated();
        if ($this->data['image'] == null) {
            $this->data['image'] = 'https://res.cloudinary.com/doy3slx9i/image/upload/v1729583527/itech_images/not-found_wqnrcf.jpg';
        }
        return $this->repository->update($id, $this->data);
    }
}