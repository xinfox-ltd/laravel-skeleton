<?php

/**
 * Copyright (c) 2023 Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductionBaseItem extends Model
{
    protected $fillable = [
        'enterprise_id',
        'production_base_id',
        'enterprise_staff_id',
        'name',
        'regional_location',
        'area',
        'area_unit',
        'lng',
        'lat',
        'remark',
    ];

    public function manager(): BelongsTo
    {
        return $this->belongsTo(EnterpriseStaff::class, 'enterprise_staff_id');
    }
}
