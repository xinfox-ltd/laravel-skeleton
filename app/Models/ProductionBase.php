<?php

/**
 * Copyright (c) 2023 Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductionBase extends Model
{
    protected $casts = [
        'images' => 'array'
    ];

    protected $fillable = [
        'enterprise_id',
        'type',
        'name',
        'base_no',
        'director',
        'phone',
        'region',
        'village_num',
        'farmer_num',
        'area',
        'lng',
        'lat',
        'images',
    ];
}
