<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Services;

use App\Models\ProductionBase;
use App\Models\ProductionBaseItem;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class ProductionBaseItemService
{
    public function list(User $user, int $id, array $params): Collection
    {
        return ProductionBase::where('enterprise_id', $user->enterprise_id)
            ->where('id', $id)
            ->firstOrFail()
            ->items()
            ->when($params['keyword'] ?? null, function ($query, $keyword) {
                $query->where('name', 'LIKE', "%$keyword%");
            })
            ->orderBy('id', 'DESC')
            ->get();
    }

    public function save(User $user, array $data)
    {
        $data['remark'] ??= '';

        if (empty($data['id'])) {
            $data['enterprise_id'] = $user->enterprise_id;
            return ProductionBaseItem::create($data);
        } else {
            $productionBaseItem = $this->getProductionBaseItem($user, $data['id']);
            $productionBaseItem->update($data);
            return $productionBaseItem;
        }
    }

    public function delete(User $user, int $id): void
    {
        $this->getProductionBaseItem($user, $id)->delete();
    }

    public function getProductionBaseItem(User $user, int $id): ProductionBaseItem
    {
        return ProductionBaseItem::where('id', $id)
            ->where('enterprise_id', $user->enterprise_id)
            ->firstOrFail();
    }
}
