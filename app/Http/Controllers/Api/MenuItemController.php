<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\MenuItem\StoreMenuItemRequest;
use App\Http\Requests\MenuItem\UpdateMenuItemRequest;
use App\Services\MenuItemService;
use Exception;
use Illuminate\Http\Request;

class MenuItemController extends BaseController
{
    protected MenuItemService $menuItemService;

    public function __construct(MenuItemService $menuItemService)
    {
        $this->menuItemService = $menuItemService;
    }

    public function index(Request $request)
    {
        $limit = $request->get('limit', 10);
        $menuItems = $this->menuItemService->all($limit);

        return $this->sendResponseSuccess(
            [
                'menuItems' => $menuItems,
            ], __('common.created')
        );
    }

    public function store(StoreMenuItemRequest $request)
    {
        $data = $request->validated();
        $menuItem = $this->menuItemService->create($data);

        return $this->sendResponseSuccess(
            ['menuItem' => $menuItem], __('common.created')
        );
    }

    public function show($id)
    {
        try {
            $menuItem = $this->menuItemService->show($id);

            return $this->sendResponseSuccess(
                ['menuItem' => $menuItem],
            );
        } catch (Exception $ex) {
            return $this->sendResponseError([
                'message' => $ex->getMessage(),
            ], __('common.not_found'), 404);
        }
    }

    public function update(UpdateMenuItemRequest $request, $id)
    {
        try {
            $menuItem = $request->validated();
            $menuItem = $this->menuItemService->update($menuItem, $id);

            return $this->sendResponseSuccess(
                ['menuItem' => $menuItem], __('common.updated')
            );
        } catch (Exception $ex) {
            return $this->sendResponseError([
                'message' => $ex->getMessage(),
            ], __('common.not_found'), 404);
        }
    }

    public function destroy($id)
    {
        try {
            $this->menuItemService->delete($id);

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
