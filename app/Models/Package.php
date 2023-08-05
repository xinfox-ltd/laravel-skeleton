<?php

/**
 * Copyright (c) 2023 Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $casts = [
        'images' => 'json'
    ];

    protected $fillable = [
        'enterprise_id',
        'enterprise_product_id',
        'name',
        'spec',
        'images',
    ];
}
