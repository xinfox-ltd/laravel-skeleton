<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Services;

use App\Models\ProductionBase;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductionBaseService
{
    public function list(array $params = []): LengthAwarePaginator
    {
        return ProductionBase::orderBy('id', 'DESC')
            ->paginate();

    }

    public function save()
    {

    }
}
