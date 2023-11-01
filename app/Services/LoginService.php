<?php

/**
 * Copyright (c) 2023 Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Services;

use App\Exceptions\PasswordErrorException;
use App\Http\Resources\EnterpriseResource;
use App\Models\Enterprise;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use JetBrains\PhpStorm\ArrayShape;

class LoginService
{
    /**
     * @param string $username
     * @param string $password
     * @return array
     * @throws ValidationException
     */
    public function accountPasswordLogin(string $username, string $password): array
    {
        $user = User::where('username', $username)->first();
        if (!$user) {
            throw ValidationException::withMessages(['username' => '用户不存在']);
        }

        if (!$user->verifyPassword($password)) {
            throw ValidationException::withMessages(['username' => '密码错误']);
        }

        $enterprise = null;
        if ($user->enterprise_id > 0) {
            $enterprise = new EnterpriseResource(Enterprise::find($user->enterprise_id));
        }

        return [
            'user' => [...$user->toArray(), 'dashboard' => 1],
            'enterprise' => $enterprise,
            'token' => $this->respondWithToken($user->createToken('admin')->plainTextToken)
        ];
    }

    /**
     * Helper function to format the response with the token.
     *
     * @param $token
     * @return array
     */
    #[ArrayShape(['token' => "", 'token_type' => "string", 'expires_in' => "float|int"])]
    private function respondWithToken($token): array
    {
        return [
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => max(config('sanctum.expiration') * 60, 7200)
        ];
    }
}
