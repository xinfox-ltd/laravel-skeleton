<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RawMaterial extends Model
{
    protected $fillable = [
        'enterprise_id',
        'name',
        'level',
        'requirement',
    ];
}
