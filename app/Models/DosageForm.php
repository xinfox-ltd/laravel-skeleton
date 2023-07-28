<?php

/**
 * Copyright (c) 2023 Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DosageForm extends Model
{
    protected $fillable = [
        'name',
        'input_category_id',
        'remark',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(InputCategory::class, 'input_category_id');
    }
}
