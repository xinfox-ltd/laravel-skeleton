<?php

/**
 * Copyright (c) 2023 Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Services;

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class SupplierService
{
    public function list(User $user, array $params = []): LengthAwarePaginator
    {
        return Supplier::where('enterprise_id', $user->enterprise_id)
            ->when($params['keyword'] ?? null, function($query, $keyword) {
                $query->where('name', 'LIKE', "%$keyword%");
            })
            ->orderBy('id', 'DESC')
            ->paginate($params['page_size'] ?? 20);
    }

    public function save(array $data)
    {
        $data['remark'] ??= '';
        if (empty($data['id'])) {
            return Supplier::create($data);
        } else {
            $supplier = Supplier::findOrFail($data['id']);
            $supplier->update($data);
            return $supplier;
        }
    }

    public function delete(int $id)
    {
    }
}
