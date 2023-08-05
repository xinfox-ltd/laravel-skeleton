<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Services;

use App\Models\EnterpriseStaff;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class EnterpriseStaffService
{
    public function list(int $enterpriseId, array $params): array|LengthAwarePaginator
    {
        return EnterpriseStaff::where('enterprise_id', $enterpriseId)
            ->when($params['keyword'] ?? null, function ($query, $keyword) {
                $query->where('name', 'LIKE', "%$keyword%");
            })
            ->paginate($params['page_size'] ?? 20);
    }

    public function save(array $data): EnterpriseStaff
    {
        if (empty($data['id'])) {
            return EnterpriseStaff::create($data);
        } else {
            $enterpriseStaff = EnterpriseStaff::findOrFail($data['id']);
            $enterpriseStaff->update($data);
            return $enterpriseStaff;
        }
    }

    public function delete(User $user, int $id): void
    {
        EnterpriseStaff::where('id', $id)
            ->where('enterprise_id', $user->enterprise_id)
            ->firstOrFail()
            ->delete();
    }
}
