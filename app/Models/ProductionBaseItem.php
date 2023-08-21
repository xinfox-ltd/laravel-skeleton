<?php

/**
 * Copyright (c) 2023 Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Models;

class ProductionBaseItem extends Model
{
    protected $fillable = [
        'production_base_id',
        'user_id',
        'name',
        'regional_location',
        'area',
        'lng',
        'lat',
        'remark',
    ];
}
