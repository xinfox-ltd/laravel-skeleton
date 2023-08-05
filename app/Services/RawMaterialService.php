<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Services;

use App\Models\RawMaterial;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class RawMaterialService
{
    public function list(User $user, array $params): LengthAwarePaginator
    {
        return RawMaterial::where('enterprise_id', $user->enterprise_id)
            ->when($params['keyword'] ?? null, function ($query, $keyword) {
                $query->where('name', 'LIKE', "%$keyword%");
            })
            ->paginate($params['page_size'] ?? 20);
    }

    public function save(User $user, array $data)
    {
        $data['enterprise_id'] = $user->enterprise_id;
        if (empty($data['id'])) {
            return RawMaterial::create($data);
        } else {
            $rawMaterial = $this->getRawMaterial($user, $data['id']);
            $rawMaterial->update($data);
            return $rawMaterial;
        }
    }

    public function delete(User $user, int $id): void
    {
        $this->getRawMaterial($user, $id)->delete();
    }

    public function getRawMaterial(User $user, int $id): RawMaterial
    {
        return RawMaterial::where('id', $id)
            ->where('enterprise_id', $user->enterprise_id)
            ->firstOrFail();
    }
}
