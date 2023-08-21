<?php

/**
 * Copyright (c) 2023 Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductionBase extends Model
{
    protected $casts = [
        'images' => 'array'
    ];

    protected $fillable = [
        'enterprise_id',
        'type',
        'name',
        'region',
        'area',
        'lng',
        'lat',
        'images',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(ProductionBaseItem::class);
    }
}
