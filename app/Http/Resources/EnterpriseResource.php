<?php

/*
 * Copyright (c) 2023 Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Enterprise;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Enterprise */
class EnterpriseResource extends JsonResource
{
    /**
     * 应该应用的「数据」包装器。
     *
     * @var string|null
     */
    public static $wrap = 'ddddddddddd';

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'type_label' => $this->type_label,
            'legal_person' => $this->legal_person,
            'phone' => $this->phone,
            'address' => $this->address,
            'products' => $this->products,
            'intro' => $this->intro,
            'status' => $this->status,
            'status_label' => $this->status_label,
            'audited_at' => $this->audited_at,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }

    public function paginationInformation($request, $paginated, $default)
    {
        dd($request, $paginated, $default);
    }
}
