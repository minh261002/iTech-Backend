<?php

namespace App\Repositories;

use App\Models\Module;
use App\Repositories\Interfaces\ModuleRepositoryInterface;

class ModuleRepository extends BaseRepository implements ModuleRepositoryInterface
{
    public function getModel()
    {
        return Module::class;
    }
}