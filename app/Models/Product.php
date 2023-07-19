<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $casts = [
        'images' => 'json'
    ];
    protected $fillable = [
        'name',
        'images',
        'origin',
        'intro',
    ];
}
