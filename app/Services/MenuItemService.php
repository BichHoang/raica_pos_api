<?php


namespace App\Services;

use App\Models\MenuItem;
use App\Repositories\MenuItemRepository;

class MenuItemService
{
    protected MenuItemRepository $repository;

    public function __construct(MenuItemRepository $repository)
    {
        $this->repository = $repository;
    }

    public function all($limit = null)
    {
        return is_null($limit) ? $this->repository->all() : $this->repository->paginate($limit);
    }

    public function create($Store): ?MenuItem
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
