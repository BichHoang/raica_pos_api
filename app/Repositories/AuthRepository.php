<?php

namespace App\Repositories;

use App\Models\User;
use Prettus\Repository\Eloquent\BaseRepository;

class AuthRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return User::class;
    }
}
