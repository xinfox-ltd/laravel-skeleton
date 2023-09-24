<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class PlantingPlan extends Model
{
    protected $fillable = [
        'enterprise_id',
        'production_base_id',
        'product_id',
        'name',
        'staff_id',
        'end_date',
        'status',
    ];
}
