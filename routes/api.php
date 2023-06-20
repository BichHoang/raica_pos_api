<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers\Api'
], function () {
    Route::get('/403', function () {
        $res = [
            'message' => 'Not authorized.',
            'code' => 403,
            'status_code' => App\Utils\HttpCodeTransform::STATUS_CODE[403],
        ];

        return response()->json($res, 403);
    })->name('403');

    Route::group([
        'prefix' => 'auth',
    ], function ($router) {
        $router->post('/login', 'AuthController@login');
        $router->post('/register', 'AuthController@register');
        $router->post('/forgot-password', 'PasswordController@sendPasswordResetEmail');
    });

    Route::group([
        'middleware' => 'auth:sanctum',
    ], function () {
        Route::group([
            'prefix' => 'auth',
        ], function ($router) {
            $router->delete('/logout', 'AuthController@logout');
            $router->get('/me', 'AuthController@userProfile');
            $router->post('/reset-password', 'PasswordController@resetPassword');
        });
    });
});
