<?php

/**
 * Copyright (c) 2023 Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Services;

use App\Models\Company;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CompanyService
{
    public function list(array $params = []): LengthAwarePaginator
    {
        return Company::query()->paginate($params['page_size'] ?? 10);
    }
}
