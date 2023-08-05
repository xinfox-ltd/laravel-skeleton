<?php

/**
 * Copyright (c) 2023 Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trademark extends Model
{
    protected $casts = [
        'valid_date' => 'json'
    ];

    protected $fillable = [
        'enterprise_id',
        'name',
        'registration_no',
        'icd',
        'awarding_bodies',
        'valid_date',
        'scan_file',
    ];
}
