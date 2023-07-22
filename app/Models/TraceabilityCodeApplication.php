<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TraceabilityCodeApplication extends Model
{
    protected $fillable = [
        'enterprise_id',
        'quantity',
        'status',
        'reason',
        'remark',
    ];
}
