<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\MenuItem\StoreMenuItemRequest;
use App\Http\Requests\MenuItem\UpdateMenuItemRequest;
use App\Models\MenuItem;
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
        $stores = $this->menuItemService->all($limit);

        return $this->sendResponseSuccess(
            [
                'stores' => $stores,
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
            $store = $this->menuItemService->show($id);

            return $this->sendResponseSuccess(
                ['store' => $store],
            );
        } catch (Exception $ex) {
            return $this->sendResponseError([
                'message' => $ex->getMessage(),
            ], __('common.not_found'), 404);
        }
    }

    public function update(UpdateMenuItemRequest $request, MenuItem $menuItem)
    {
        //
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
