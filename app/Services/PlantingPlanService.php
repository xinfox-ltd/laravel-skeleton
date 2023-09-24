<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Services;

use App\Models\PlantingPlan;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class PlantingPlanService
{
    public function list(User $user, array $params): LengthAwarePaginator
    {
        return PlantingPlan::where('planting_plans.enterprise_id', $user->enterprise_id)
            ->join('enterprise_staff', 'enterprise_staff.id', '=', 'planting_plans.staff_id')
            ->join('production_bases', 'production_bases.id', '=', 'planting_plans.production_base_id')
            ->join('enterprise_products', 'enterprise_products.id', '=', 'planting_plans.product_id')
            ->join('products', 'products.id', '=', 'enterprise_products.product_id')
            ->select(
                [
                    'planting_plans.*',
                    'enterprise_staff.name as staff_name',
                    'production_bases.name as production_base_name',
                    'products.name as product_name'
                ]
            )
            ->orderBy('planting_plans.id', 'DESC')
            ->paginate($params['page_size'] ?? 20);
    }

    public function save(array $data): PlantingPlan
    {
        if (empty($data['id'])) {
            return PlantingPlan::create($data);
        } else {
            $plantingPlan = PlantingPlan::findOrFail($data['id']);
            $plantingPlan->update($data);
            return $plantingPlan;
        }
    }

    public function delete(int $id): void
    {
        PlantingPlan::findOrFail($id)->delete();
    }

    /**
     * @param int $id
     * @return PlantingPlan
     */
    public function get(int $id): PlantingPlan
    {
        return PlantingPlan::findOrFail($id);
    }
}
