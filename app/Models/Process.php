<?php

/**
 * Copyright (c) 2023 Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Models;

class Process extends Model
{
    protected $fillable = [
        'enterprise_id',
        'name',
        'process_flow_id',
        'enterprise_product_id',
        'production_base_id',
    ];
}
