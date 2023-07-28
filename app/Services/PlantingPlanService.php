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
        return PlantingPlan::where('enterprise_id', $user->enterprise_id)
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
