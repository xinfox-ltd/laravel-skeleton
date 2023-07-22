<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService
{
    public function list(User $user, array $params): LengthAwarePaginator
    {
        return User::when($params['enterprise_id'] ?? null, function($query, $enterpriseId) {
            $query->where('enterprise_id', $enterpriseId);
        })->paginate($params['page_size'] ?? 20);
    }

    public function save(array $data)
    {
        return User::create($data);
    }
}
