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

    protected $appends = [
        'status_label'
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

    public function statusLabel(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->status->label()
        );
    }

    public function status(): Attribute
    {
        return Attribute::make(
            get: fn ($status) => TraceabilityCodeStatus::from(intval($status)),
            set: function ($status) {
                return $status instanceof TraceabilityCodeStatus ? $status->value : intval($status);
            }
        );
    }
}
