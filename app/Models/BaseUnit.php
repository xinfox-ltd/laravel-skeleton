<?php

/**
 * Copyright (c) 2023 Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseUnit extends Model
{
    protected $fillable = [
        'region_id',
        'name',
        'unit_no',
        'director',
        'phone',
        'village_num',
        'farmer_num',
        'area',
    ];
}
