<?php

namespace App\Models;

use App\Enums\TraceabilityCodeStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property TraceabilityCodeStatus $status
 */
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

    protected $casts = [
        'is_can_enabled' => 'boolean'
    ];

    protected $appends = [
        'status_label',
        'url'
    ];

    public function harvestPlan(): BelongsTo
    {
        return $this->belongsTo(HarvestPlan::class);
    }

    public function report(): BelongsTo
    {
        return $this->belongsTo(Report::class);
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function process(): BelongsTo
    {
        return $this->belongsTo(Process::class);
    }

    public function productionBaseItem(): BelongsTo
    {
        return $this->belongsTo(ProductionBaseItem::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(EnterpriseProduct::class, 'enterprise_product_id');
    }

    public function enterprise(): BelongsTo
    {
        return $this->belongsTo(Enterprise::class, 'enterprise_id');
    }

    public function statusLabel(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->status->label()
        );
    }

    public function status(): Attribute
    {
        return Attribute::make(
            get: fn($status) => TraceabilityCodeStatus::from(intval($status)),
            set: function ($status) {
                return $status instanceof TraceabilityCodeStatus ? $status->value : intval($status);
            }
        );
    }

    public function url(): Attribute
    {
        return Attribute::make(
            get: function () {
                return config('app.h5_url') . '?id=' . $this->id;
            }
        );
    }
}
