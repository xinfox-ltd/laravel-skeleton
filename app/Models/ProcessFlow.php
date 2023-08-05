<?php

/**
 * Copyright (c) 2023 Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class ProcessFlow extends Model
{
    protected $casts = [
        'steps' => 'json'
    ];

    protected $fillable = [
        'enterprise_id',
        'name',
        'steps',
        'remark',
    ];

    public function steps(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                if (!is_array($value)) {
                    return json_encode([]);
                }
                foreach ($value as &$item) {
                    if (!empty($item['head'] && is_array($item['head']))) {
                        $item['head'] = [
                            'id' => $item['head']['id'],
                            'name' => $item['head']['name']
                        ];
                    }
                }
                return json_encode($value);
            }
        );
    }
}
