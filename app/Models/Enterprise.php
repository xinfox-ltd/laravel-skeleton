<?php

namespace App\Models;

use App\Enums\EnterpriseType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Enterprise extends Model
{
//    use SerializeDateable;

    protected $casts = [
        'type' => 'integer',
        'products' => 'json'
    ];

    protected $fillable = [
        'lng',
        'lat',
        'business_license',
        'name',
        'type',
        'legal_person',
        'phone',
        'address',
        'products',
        'status',
        'audited_at',
        'intro'
    ];

    protected $appends = [
        'type_label',
        'status_label'
    ];

    public function typeLabel(): Attribute
    {
        return Attribute::make(
            get: fn () => EnterpriseType::from($this->type)->label()
        );
    }

    public function statusLabel(): Attribute
    {
        return Attribute::make(
            get: fn () => [1 => '待审核', 10 => '审核通过'][$this->status] ?? '-'
        );
    }

    protected function serializeDate(\DateTimeInterface $date): string
    {
        return $date->format($this->dateFormat ?: 'Y-m-d H:i:s');
    }
}
