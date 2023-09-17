<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TraceabilityCode extends Model
{
    protected $fillable = [
        'code',
        'enterprise_id',
        'effective_day',
        'enable_date',
        'expire_date',
        'scan_num',
        'status',
    ];
}
