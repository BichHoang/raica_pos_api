<?php

namespace App\Repositories;

use App\Models\MenuItem;
use Prettus\Repository\Eloquent\BaseRepository;

class MenuItemRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return MenuItem::class;
    }
}
