<?php
/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HarvestPlan extends Model
{
    protected $fillable = [
        'enterprise_id',
        'planting_plan_id',
        'raw_material_id',
        'staff_id',
        'name',
        'start_date',
        'end_date',
        'remark',
    ];
}
