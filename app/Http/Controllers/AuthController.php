<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class AuthController extends BaseController
{
    public function __construct(private AuthService $authService) {}

    public function login(LoginRequest $loginRequest): JsonResponse
    {
        $this->ensureIsNotRateLimited($loginRequest);

        $data = $loginRequest->validated();
        $token = $this->authService->login(email: $data['email'], password: $data['password']);
        return $this->sendResponse(['token' => $token]);
    }

    private function ensureIsNotRateLimited(Request $request): void
    {
        if (RateLimiter::tooManyAttempts($this->throttleKey($request), 5)) {
            throw ValidationException::withMessages([
                'email' => __('validation.throtlle_login_limit', [
                    'seconds' => RateLimiter::availableIn($this->throttleKey($request)),
                ]),
            ]);
        }

        RateLimiter::hit($this->throttleKey($request));
    }

    private function throttleKey(Request $request): string
    {
        return 'email:' . $request->input('email') . ':' . $request->ip();
    }
}
