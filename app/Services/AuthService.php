<?php


namespace App\Services;

use App\Models\User;
use App\Repository\AuthRepository;
use App\Http\Helpers\Helper;
use Prettus\Validator\Exceptions\ValidatorException;

class AuthService
{
    /**
     * @var AuthRepository
     */
    protected AuthRepository $repository;

    /**
     * AuthService constructor.
     *
     * @param AuthRepository $repository
     */
    public function __construct(AuthRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $user
     *
     * @return User|null
     */
    public function create($user): ?User
    {
        return $this->repository->create($user);
    }
}
