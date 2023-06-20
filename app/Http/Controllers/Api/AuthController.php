<?php

/**
 * @author Bich Hoang <bichht.dev@gmail.com>
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\AuthService;
use App\Utils\ConstDefinition;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends BaseController
{
    /**
     * @var AuthService $authService
     */
    private AuthService $authService;

    /**
     * AuthController constructor.
     *
     * @param AuthService $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @param UserLoginRequest $request
     *
     * @return JsonResponse
     * @throws AuthenticationException
     * @author Bich Hoang <bichht.dev@gmail.com>
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'auth' => [__('auth.failed')],
            ]);
        }

        $response = [
            'access_token' => $user->createToken(ConstDefinition::AUTH_TOKEN)->plainTextToken,
            'token_type' => 'Bearer',
        ];

        return $this->sendResponseSuccess($response);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        // auth()->user()->tokens()->delete(); // Log out all devices
        auth()->user()->currentAccessToken()->delete();

        return $this->sendResponseSuccess(null, __('auth.logout_success'));
    }

    /**
     * @param RegisterUserRequest $request
     *
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = $this->authService->create(array_merge($data, ['password' => bcrypt($data['password'])]));

        return $this->sendResponseSuccess(['user' => $user], __('common.created'));
    }

    /**
     * @return JsonResponse
     */
    public function userProfile(): JsonResponse
    {
        return $this->sendResponseSuccess(new UserResource(auth()->user()));
    }
}
