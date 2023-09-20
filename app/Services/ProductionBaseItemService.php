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
    public function list(User $user, array $params): Collection
    {
        $baseId = $params['base_id'] ?? 0;
        if ($baseId) {
            $query = ProductionBase::where('enterprise_id', $user->enterprise_id)
                ->where('id', $baseId)
                ->firstOrFail()
                ->items();
        } else {
            $query = ProductionBaseItem::where('enterprise_id', $user->enterprise_id);
        }

        return $query->when($params['keyword'] ?? null, function ($query, $keyword) {
                $query->where('name', 'LIKE', "%$keyword%");
            })
            ->with(['manager'])
            ->orderBy('id', 'DESC')
            ->get();
    }

    public function save(User $user, array $data)
    {
        $data['remark'] ??= '';
        $data['regional_location'] ??= '';

        if (empty($data['id'])) {
            $data['enterprise_id'] = $user->enterprise_id;
            return ProductionBaseItem::create($data);
        } else {
            $productionBaseItem = $this->getProductionBaseItem($user, $data['id']);
            $productionBaseItem->update($data);
            return $productionBaseItem;
        }
    }

    public function delete(User $user, int $baseId, int $id): void
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
