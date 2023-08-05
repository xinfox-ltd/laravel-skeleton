<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Mountain\Http\Resources\ResourceCollection;

/** @see \App\Models\PlantingAssignmentInput */
class PlantingAssignmentInputCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return $this->collection->toArray();
    }
}
