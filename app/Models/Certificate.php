<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $casts = [
        'scan_file' => 'json'
    ];

    protected $fillable = [
        'enterprise_id',
        'type',
        'subtype',
        'name',
        'certificate_no',
        'authority',
        'valid_date',
        'scan_file',
    ];

    protected $appends = [
        'type_label'
    ];

    public function typeLabel(): Attribute
    {
        return Attribute::make(
            get: fn() => [1 => '地理标志认证', 2 => '企业资质', 3 => '产品认证', 4 => '其他'][$this->type] ?? '-'
        );
    }
}
