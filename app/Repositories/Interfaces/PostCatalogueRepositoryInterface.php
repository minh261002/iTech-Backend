<?php

namespace App\Repositories\Interfaces;

interface PostCatalogueRepositoryInterface extends BaseRepositoryInterface
{
    public function getFlatTreeNotInNode(array $nodeId);

    public function getFlatTree();

    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');

}
