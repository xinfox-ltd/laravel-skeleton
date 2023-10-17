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
        })->orderBy('id', 'DESC')->paginate($params['page_size'] ?? 20);
    }

    public function save(array $data)
    {
        if (empty($data['id'])) {
            $data['type'] = 2;
            return User::create($data);
        } else {
            $user = User::findOrFail($data['id']);

            unset($data['password']);

            $user->update($data);
            return $user;
        }
    }
}
