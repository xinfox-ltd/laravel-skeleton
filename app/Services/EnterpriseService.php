<?php

/**
 * Copyright (c) 2023 Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Services;

use App\Models\Enterprise;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EnterpriseService
{
    public function list(array $params = []): LengthAwarePaginator
    {
        return Enterprise::when($params['keyword'] ?? null, function ($query, $keyword) {
            $query->where('name', 'LIKE', "%$keyword%");
        })
            ->orderBy('id', 'DESC')
            ->paginate($params['page_size'] ?? 10);
    }

    /**
     * @param array $data
     * @return Enterprise
     */
    public function save(array $data): Enterprise
    {
        $data['status'] = 1;
        return Enterprise::create($data);
    }
}
