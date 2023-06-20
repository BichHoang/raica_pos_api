<?php

/**
 * @author Bich Hoang <bichht.dev@gmail.com>
 */

namespace App\Http\Controllers\Api;

use App\Http\Requests\Auth\ResetPasswordRequest;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class PasswordController extends BaseController
{
    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function sendPasswordResetEmail(Request $request): JsonResponse
    {
        $url = config('app.url');
        ResetPassword::createUrlUsing(
            fn($notifiable, $token) => "$url/password/reset/$token?email={$notifiable->getEmailForPasswordReset()}"
        );
        Password::sendResetLink($request->only('email'));

        return $this->sendResponseSuccess(null, trans('passwords.sent'));
    }

    /**
     * @param ResetPasswordRequest $request
     *
     * @return JsonResponse
     */
    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        $data = $request->only('email', 'password', 'password_confirmation', 'token');
        $status = Password::reset($data, function ($user, $password) {
            $user->forceFill(['password' => Hash::make($password)])->setRememberToken(Str::random(60));
            $user->save();
            event(new PasswordReset($user));
        });

        switch ($status) {
            case Password::PASSWORD_RESET:
                return $this->sendResponseSuccess(null, trans('passwords.reset'));
            case Password::INVALID_USER:
                return $this->sendResponseError(null, trans('passwords.user'), 400);
            case Password::INVALID_TOKEN:
                return $this->sendResponseError(null, trans('passwords.token'), 400);
            default:
                return $this->sendResponseError(null, trans('common.bad_request'), 400);
        }
    }
}
