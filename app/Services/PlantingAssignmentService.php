<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Services;

use App\Models\PlantingAssignment;
use App\Models\PlantingAssignmentInput;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PlantingAssignmentService
{
    public function list(User $user, array $params): LengthAwarePaginator
    {
        return PlantingAssignment::where('planting_assignments.enterprise_id', $user->enterprise_id)
            ->join('planting_plans', 'planting_plans.id', '=', 'planting_assignments.planting_plan_id')
            ->select(['planting_assignments.*', 'planting_plans.name as planting_plan_name'])
            ->orderBy('planting_assignments.id', 'DESC')
            ->paginate($params['page_size'] ?? 20);
    }

    public function save(array $data): PlantingAssignment
    {
        if (!empty($data['date']) && is_array($data['date'])) {
            $data['start_date'] = $data['date'][0];
            $data['end_date'] = $data['date'][1];
        }

        if (empty($data['id'])) {
            return PlantingAssignment::create($data);
        } else {
            $plantingAssignment = PlantingAssignment::findOrFail($data['id']);
            $plantingAssignment->update($data);
            return $plantingAssignment;
        }
    }

    public function delete(User $user, int $id): void
    {
        $this->get($user, $id)->delete();
    }

    /**
     * @param User $user
     * @param int $id
     * @return PlantingAssignment
     */
    public function get(User $user, int $id): PlantingAssignment
    {
        return PlantingAssignment::where('id', $id)
            ->where('enterprise_id', $user->enterprise_id)
            ->firstOrFail();
    }

    public function getInputList($id, array $params): Collection
    {
        return PlantingAssignment::findOrFail($id)
            ->inputs()
            ->when($params['keyword'] ?? null, function($query, $keyword) {
                $query->where('name', 'LIKE', "%$keyword%");
            })
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * @param User $user
     * @param array $data
     * @return PlantingAssignmentInput
     */
    public function saveInput(User $user, array $data): PlantingAssignmentInput
    {
        $data['remark'] ??= '';
        if (empty($data['id'])) {
            $data['enterprise_id'] = $user->enterprise_id;
            $plantingAssignment = PlantingAssignment::findOrFail($data['planting_assignment_id']);
            $data['input_date'] = [$plantingAssignment->start_date, $plantingAssignment->end_date];
            return PlantingAssignmentInput::create($data);
        } else {
            $plantingAssignmentInput = PlantingAssignmentInput::where('id', $data['id'])->firstOrFail();
            $plantingAssignmentInput->update($data);
            return $plantingAssignmentInput;
        }
    }

    public function destroyInput(User $user, int $plantingAssignmentId, int $iid): void
    {
        PlantingAssignmentInput::where('enterprise_id', $user->enterprise_id)
            ->where('planting_assignment_id', $plantingAssignmentId)
            ->where('id', $iid)
            ->firstOrFail()
            ->delete();
    }
}
