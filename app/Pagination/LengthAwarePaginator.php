<?php

/**
 * Copyright (c) 2023 Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Pagination;

class LengthAwarePaginator extends \Illuminate\Pagination\LengthAwarePaginator
{
    public function toArray(): array
    {
        return [
            'items' => $this->items->toArray(),
            'total' => $this->total()
        ];
    }
}
