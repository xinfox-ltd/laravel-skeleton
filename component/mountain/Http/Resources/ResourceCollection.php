<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace Mountain\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection as LaravelResourceCollection;

class ResourceCollection extends LaravelResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'rows' => $this->collection->toArray()
        ];
    }

    public function paginationInformation($request, $paginated, $default): array
    {
        return [
            'code' => 200,
            'data' => $default,
            'message' => 'SUCCESS'
        ];
    }
}
