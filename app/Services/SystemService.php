<?php

/**
 * Copyright (c) 2023 Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Services;

class SystemService
{
    public function menuList()
    {
        $menu = config('menu');
        return [
            'dashboardGrid' => ["time", 'about'],
            'menu' => $menu,
            'permissions' => ['list.add', 'list.edit', 'list.delete', 'user.add', 'user.edit', 'user.delete']
        ];
    }
}
