<?php

namespace App\Services;
use App\Repositories\Interfaces\PostCatalogueRepositoryInterface;
use App\Services\Interfaces\PostCatalogueServiceInterface;
use Illuminate\Http\Request;

class PostCatalogueService implements PostCatalogueServiceInterface
{
    protected $data;

    protected $repository;

    public function __construct(PostCatalogueRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create(Request $request)
    {

        $this->data = $request->validated();
        $data['image'] = $data['image'] ?? 'https://i0.wp.com/sbcf.fr/wp-content/uploads/2018/03/sbcf-default-avatar.png?ssl=1';


        return $this->repository->create($this->data);
    }

    public function update(Request $request, $id)
    {
        $this->data = $request->validated();
        $data['image'] = $data['image'] ?? 'https://i0.wp.com/sbcf.fr/wp-content/uploads/2018/03/sbcf-default-avatar.png?ssl=1';
        return $this->repository->update($id, $this->data);
    }
}
