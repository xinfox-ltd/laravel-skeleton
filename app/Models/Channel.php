<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = [
        'enterprise_id',
        'type',
        'name',
        'data',
    ];

    protected $casts = [
        'data' => 'array',
    ];
}
