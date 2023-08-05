<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PlantingAssignment extends Model
{
    protected $fillable = [
        'enterprise_id',
        'planting_plan_id',
        'assignment_content',
        'start_date',
        'end_date',
    ];

    public function inputs(): BelongsToMany
    {
        return $this->belongsToMany(Input::class, 'planting_assignment_input')
            ->using(PlantingAssignmentInput::class)
            ->withPivot([
                'id',
                'quantity',
                'unit_type',
                'unit_id',
                'method',
                'input_date',
                'remark'
            ])
            ->withTimestamps();
    }
}
