<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Services;

use App\Models\TraceabilityCodeApplication;
use Illuminate\Pagination\LengthAwarePaginator;

class TraceabilityCodeApplicationService
{
    public function list(array $params): LengthAwarePaginator
    {
        return TraceabilityCodeApplication::paginate($params['page_size'] ?? 20);
    }

    /**
     * @param array $data
     * @return TraceabilityCodeApplication
     */
    public function save(array $data): TraceabilityCodeApplication
    {
        return TraceabilityCodeApplication::create($data);
    }
}
