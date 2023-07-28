<?php

/**
 * Copyright (c) 2023 Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Services;

use App\Models\User;

class SystemService
{
    public function menuList(User $user)
    {
        $menu = config($user->type == 1 ? 'menu' : 'emenu');
        return [
            'dashboardGrid' => ["time", 'about'],
            'menu' => $menu,
            'permissions' => ['list.add', 'list.edit', 'list.delete', 'user.add', 'user.edit', 'user.delete']
        ];
    }
}
