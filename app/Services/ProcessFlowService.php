<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Services;

use App\Models\ProcessFlow;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class ProcessFlowService
{
    public function list(User $user, array $params = []): LengthAwarePaginator
    {
        return ProcessFlow::where('enterprise_id', $user->enterprise_id)
            ->when($params['keyword'] ?? null, function ($query, $keyword) {
                $query->where('enterprise_id', 'LIKE', "%$keyword%");
            })
            ->orderBy('id', 'DESC')
            ->paginate($params['page_size'] ?? 10);
    }

    /**
     * @param User $user
     * @param array $data
     * @return ProcessFlow
     */
    public function save(User $user, array $data): ProcessFlow
    {
        $data['remark'] ??= '';
        if (empty($data['id'])) {
            $data['enterprise_id'] = $user->enterprise_id;
            return ProcessFlow::create($data);
        } else {
            $processFlow = $this->getProcessFlow($user, $data['id']);
            $processFlow->update($data);
            return $processFlow;
        }
    }

    public function delete(User $user, int $id): void
    {
        $this->getProcessFlow($user, $id)->delete();
    }

    public function getProcessFlow(User $user, int $id): ProcessFlow
    {
        return ProcessFlow::where('id', $id)
            ->where('enterprise_id', $user->enterprise_id)
            ->firstOrFail();
    }
}
