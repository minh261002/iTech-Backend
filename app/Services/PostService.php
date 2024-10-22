<?php

namespace App\Services;

use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Services\Interfaces\PostServiceInterface;
use Illuminate\Http\Request;

class PostService implements PostServiceInterface
{
    protected $repository;

    public function __construct(PostRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create(Request $request)
    {
        $validatedData = $request->validated();
        $catalogues = $validatedData['catalogueId'] ?? [];
        unset($validatedData['catalogueId']);

        if ($validatedData['image'] == null) {
            $validatedData['image'] = 'https://res.cloudinary.com/doy3slx9i/image/upload/v1729583527/itech_images/not-found_wqnrcf.jpg';
        }
        $post = $this->repository->create($validatedData);

        $post->catalogues()->attach($catalogues);

        return $post;
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validated();

        $catalogues = $validatedData['catalogueId'] ?? [];
        unset($validatedData['catalogueId']);

        if ($validatedData['image'] == null) {
            $validatedData['image'] = 'https://res.cloudinary.com/doy3slx9i/image/upload/v1729583527/itech_images/not-found_wqnrcf.jpg';
        }

        $post = $this->repository->update($id, $validatedData);

        $post->catalogues()->sync($catalogues);

        return $post;
    }
}