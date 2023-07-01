<?php


namespace App\Services;

use App\Models\Category;
use App\Repositories\CategoryRepository;

class CategoryService
{
    protected CategoryRepository $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function all($limit = null)
    {
        return is_null($limit) ? $this->repository->all() : $this->repository->paginate($limit);
    }

    public function create($category): ?Category
    {
        return $this->repository->create($category);
    }

    public function show($id)
    {
        return $this->repository->find($id);
    }

    public function update($category, $id)
    {
        return $this->repository->update($category, $id);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
