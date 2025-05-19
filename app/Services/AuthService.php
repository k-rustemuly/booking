<?php
declare(strict_types=1);

namespace App\Services;

use Illuminate\Validation\ValidationException;

class AuthService
{
    public function __construct()
    {}

    public function login(string $email, string $password): string
    {
        if (!$token = auth()->attempt(['email' => $email, 'password' => $password])) {
            throw ValidationException::withMessages([
                'email' => __('api.email_or_password_incorrect')
            ]);
        }
        return $token;
    }
}
