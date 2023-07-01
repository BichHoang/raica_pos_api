<?php

namespace App\Http\Controllers\Api;

use App\Models\Store;
use App\Services\StoreService;
use Illuminate\Http\Request;
use App\Http\Requests\Store\CreateStoreRequest;
use Exception;

class StoreController extends BaseController
{
    private StoreService $storeService;

    public function __construct(StoreService $storeService)
    {
        $this->storeService = $storeService;
    }

    public function index(Request $request)
    {
        $limit = $request->get('limit', 10);
        $stores = $this->storeService->all($limit);

        return $this->sendResponseSuccess(
            [
                'stores' => $stores,
            ], __('common.created')
        );
    }

    public function store(CreateStoreRequest $request)
    {
        $data = $request->validated();
        $store = $this->storeService->create($data);

        return $this->sendResponseSuccess(
            ['store' => $store], __('common.created')
        );
    }

    public function show($id)
    {
        try {
            $store = $this->storeService->show($id);

            return $this->sendResponseSuccess(
                ['store' => $store],
            );
        } catch (Exception $ex) {
            return $this->sendResponseError([
                'message' => $ex->getMessage(),
            ], __('common.not_found'), 404);
        }
    }

    public function update(Request $request, Store $store)
    {
        //
    }

    public function destroy($id)
    {
        try {
            $this->storeService->delete($id);

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
