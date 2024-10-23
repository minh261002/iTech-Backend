<?php

namespace App\Repositories;

use App\Models\SliderItem;
use App\Repositories\Interfaces\SliderItemRepositoryInterface;

class SliderItemRepository extends BaseRepository implements SliderItemRepositoryInterface
{
    public function getModel()
    {
        return SliderItem::class;
    }
}
