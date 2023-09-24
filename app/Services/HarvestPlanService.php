<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Services;

use App\Models\HarvestPlan;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class HarvestPlanService
{
    public function list(User $user, array $params): LengthAwarePaginator
    {
        return HarvestPlan::leftJoin(
            'planting_plans',
            'planting_plans.id',
            '=',
            'harvest_plans.planting_plan_id'
        )
            ->leftJoin('enterprise_staff', 'enterprise_staff.id', '=', 'harvest_plans.staff_id')
            ->leftJoin('raw_materials', 'raw_materials.id', '=', 'harvest_plans.raw_material_id')
            ->select(
                [
                    'harvest_plans.*',
                    'planting_plans.name as planting_plan_name',
                    'raw_materials.name as raw_material_name',
                    'enterprise_staff.name as staff_name'
                ]
            )
            ->where('harvest_plans.enterprise_id', $user->enterprise_id)
            ->when($params['keyword'] ?? null, function ($query, $keyword) {
                $query->where('harvest_plans.name', 'LIKE', "%$keyword%");
            })
            ->orderBy('planting_plans.id', 'DESC')
            ->paginate($params['page_size'] ?? 20);
    }

    /**
     * @param User $user
     * @param array $data
     * @return HarvestPlan
     */
    public function save(User $user, array $data): HarvestPlan
    {
        $data['remark'] ??= '';
        if (!empty($data['plan_date']) && is_array($data['plan_date'])) {
            $data['start_date'] = $data['plan_date'][0];
            $data['end_date'] = $data['plan_date'][1];
        }

        if (empty($data['id'])) {
            $data['enterprise_id'] = $user->enterprise_id;
            return HarvestPlan::create($data);
        } else {
            $harvestPlan = $this->getHarvestPlan($user, $data['id']);
            $harvestPlan->update($data);
            return $harvestPlan;
        }
    }

    public function delete(User $user, int $id): void
    {
        $this->getHarvestPlan($user, $id)->delete();
    }

    public function getHarvestPlan(User $user, int $id): HarvestPlan
    {
        return HarvestPlan::where('id', $id)
            ->where('enterprise_id', $user->enterprise_id)
            ->firstOrFail();
    }
}
