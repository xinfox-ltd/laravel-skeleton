<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Services;

use App\Models\ProductionBase;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductionBaseService
{
    public function list(User $user, array $params = []): LengthAwarePaginator
    {
        $query = ProductionBase::query();

        if ($user->isEnterprise()) {
            $query->where('enterprise_id', $user->enterprise_id);
        }

        $query->when($params['keyword'] ?? null, function($query, $keyword) {
            $query->where('name', 'LIKE', "%$keyword%");
        });

        $query->when($params['type'] ?? null, function($query, $type) {
            $query->where('type', $type);
        });

        return $query->orderBy('id', 'DESC')
            ->paginate();
    }

    public function save(array $data): ProductionBase
    {
        if (empty($data['id'])) {
            return ProductionBase::create($data);
        } else {
            $productionBase = ProductionBase::findOrFail($data['id']);
            $productionBase->update($data);
            return $productionBase;
        }
    }
}
