<?php


namespace App\Services;

use App\Models\Store;
use App\Repositories\StoreRepository;

class StoreService
{
    protected StoreRepository $repository;

    public function __construct(StoreRepository $repository)
    {
        $this->repository = $repository;
    }

    public function all($limit = null)
    {
        return is_null($limit) ? $this->repository->all() : $this->repository->paginate($limit);
    }

    public function create($Store): ?Store
    {
        return $this->repository->create($Store);
    }

    public function show($id)
    {
        return $this->repository->find($id);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
