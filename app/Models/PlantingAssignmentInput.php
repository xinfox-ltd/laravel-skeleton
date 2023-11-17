<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PlantingAssignmentInput extends Pivot
{
    /**
     * 标识 ID 是否自增
     *
     * @var bool
     */
    public $incrementing = true;

    protected $casts = [
        'input_date' => 'json'
    ];

    protected $fillable = [
        'unit_id',
        'unit_type',
        'enterprise_id',
        'planting_assignment_id',
        'input_id',
        'quantity',
        'method',
        'input_date',
        'remark',
    ];
}
