<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \App\Models\Enterprise */
class EnterpriseCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'rows' => $this->collection,
        ];
    }
}
