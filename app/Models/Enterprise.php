<?php

namespace App\Models;

use App\Enums\EnterpriseType;
use App\Support\Database\Eloquent\SerializeDateable;
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
        'name',
        'type',
        'legal_person',
        'phone',
        'address',
        'products',
        'status',
        'audited_at',
    ];

    protected $appends = [
        'type_label'
    ];

    public function typeLabel(): Attribute
    {
        return Attribute::make(
            get: fn () => EnterpriseType::from($this->type)->label()
        );
    }

    protected function serializeDate(\DateTimeInterface $date): string
    {
        return $date->format($this->dateFormat ?: 'Y-m-d H:i:s');
    }
}
