<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Certificate */
class CertificateResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'enterprise_id' => $this->enterprise_id,
            'type' => $this->type,
            'type_label' => $this->type_label,
            'subtype' => $this->subtype,
            'name' => $this->name,
            'certificate_no' => $this->certificate_no,
            'authority' => $this->authority,
            'valid_date' => $this->valid_date,
            'scan_file' => $this->scan_file,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at,
        ];
    }
}
