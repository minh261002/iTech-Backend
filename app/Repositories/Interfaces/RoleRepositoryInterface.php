<?php

namespace App\Repositories\Interfaces;

interface RoleRepositoryInterface extends BaseRepositoryInterface
{
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');
    public function getAllPermissions();
    public function getAllPermissionsNoModule();
    public function getAllModules();
    public function getAllPermissionsInAllModules();
}