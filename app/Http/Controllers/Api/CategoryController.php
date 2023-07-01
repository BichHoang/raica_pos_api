<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $limit = $request->get('limit', 10);
        $categories = $this->categoryService->all($limit);

        return $this->sendResponseSuccess(
            [
                'categories' => $categories,
            ], __('common.created')
        );
    }

    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();
        $category = $this->categoryService->create($data);

        return $this->sendResponseSuccess(
            ['category' => $category], __('common.created')
        );
    }

    public function show($id)
    {
        try {
            $store = $this->categoryService->show($id);

            return $this->sendResponseSuccess(
                ['store' => $store],
            );
        } catch (Exception $ex) {
            return $this->sendResponseError([
                'message' => $ex->getMessage(),
            ], __('common.not_found'), 404);
        }
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
    }

    public function destroy($id)
    {
        try {
            $this->categoryService->delete($id);

            return $this->sendResponseSuccess(
                [], __('common.deleted')
            );
        } catch (Exception $ex) {
            return $this->sendResponseError([
                'message' => $ex->getMessage(),
            ], __('common.not_found'), 404);
        }
    }
}
