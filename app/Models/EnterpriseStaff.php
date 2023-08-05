<?php

/**
 * Copyright (c) 2023 Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnterpriseStaff extends Model
{
    protected $fillable = [
        'enterprise_id',
        'name',
        'phone',
    ];
}
