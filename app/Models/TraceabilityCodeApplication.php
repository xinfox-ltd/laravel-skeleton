<?php

namespace App\Models;

use App\Enums\TraceabilityCodeApplicationStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property TraceabilityCodeApplicationStatus $status
 */
class TraceabilityCodeApplication extends Model
{
    protected $fillable = [
        'enterprise_id',
        'quantity',
        'status',
        'reason',
        'remark',
    ];

    protected $casts = [
        'audit_at' => 'datetime'
    ];

    protected $appends = [
        'status_label'
    ];

    public function enterprise(): BelongsTo
    {
        return $this->belongsTo(Enterprise::class, 'enterprise_id');
    }

    public function status(): Attribute
    {
        return Attribute::make(
            get: fn($status) => TraceabilityCodeApplicationStatus::from(intval($status)),
            set: function ($status) {
                return $status instanceof TraceabilityCodeApplicationStatus ? $status->value : intval($status);
            }
        );
    }

    public function statusLabel(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->status->label()
        );
    }
}
