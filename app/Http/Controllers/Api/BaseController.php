<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Utils\HttpCodeTransform;

class BaseController extends Controller
{
    public function sendResponseError($error, $message, $code)
    {
        $res = [
            'errors' => $error,
            'message' => $message,
            'code' => $code,
            'status_code' => HttpCodeTransform::STATUS_CODE[$code],
        ];

        return response()->json($res, $code);
    }

    public function sendResponseSuccess($data, $message = '', $code = 200)
    {
        $res = [
            'data' => $data,
            'message' => $message ?? '',
            'code' => $code,
            'status_code' => HttpCodeTransform::STATUS_CODE[$code],
        ];

        return response()->json($res, $code);
    }
}
