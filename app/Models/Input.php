<?php

/**
 * Copyright (c) 2023 Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Input extends Model
{
    protected $fillable = [
        'enterprise_id',
        'input_category_id',
        'dosage_form_id',
        'name',
        'supplier_id',
        'enterprise',
        'registration_no',
        'component',
        'executive_standard',
        'annex',
    ];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }
}
