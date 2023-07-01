<?php

namespace App\Repositories;

use App\Models\Category;
use Prettus\Repository\Eloquent\BaseRepository;

class CategoryRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Category::class;
    }
}
