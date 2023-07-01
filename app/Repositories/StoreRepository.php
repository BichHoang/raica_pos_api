<?php

namespace App\Repositories;

use App\Models\Store;
use Prettus\Repository\Eloquent\BaseRepository;

class StoreRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Store::class;
    }
}
