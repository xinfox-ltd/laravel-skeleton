<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    protected $casts = [
        'scan_file' => 'json'
    ];

    protected $fillable = [
        'enterprise_id',
        'name',
        'enterprise_product_id',
        'detection_type',
        'detection_institution',
        'is_qualified',
        'report_date',
        'remark',
        'scan_file',
    ];

    public function enterpriseProduct(): BelongsTo
    {
        return $this->belongsTo(EnterpriseProduct::class, 'enterprise_product_id');
    }

    public function scanFile()
    {
        return Attribute::make(
            set: function ($value) {
                return is_array($value) ? $value : explode(',', $value);
            }
        );
    }
}
