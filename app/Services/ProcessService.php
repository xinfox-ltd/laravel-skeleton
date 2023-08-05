<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Services;

use App\Models\Process;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class ProcessService
{
    public function list(User $user, array $params = []): LengthAwarePaginator
    {
        return Process::where('processes.enterprise_id', $user->enterprise_id)
            ->leftJoin('process_flows', 'process_flows.id', '=', 'processes.process_flow_id')
            ->leftJoin('enterprise_products', 'enterprise_products.id', '=', 'processes.enterprise_product_id')
            ->leftJoin('products', 'products.id', '=', 'enterprise_products.product_id')
            ->leftJoin('production_bases', 'production_bases.id', '=', 'processes.production_base_id')
            ->select(
                [
                    'processes.*',
                    'products.name as enterprise_product_name',
                    'production_bases.name as production_base_name',
                    'process_flows.name as process_flow_name'
                ]
            )
            ->when($params['keyword'] ?? null, function ($query, $keyword) {
                $query->where('processes.name', 'LIKE', "%$keyword%");
            })
            ->orderBy('processes.id', 'DESC')
            ->paginate($params['page_size'] ?? 10);
    }

    /**
     * @param User $user
     * @param array $data
     * @return Process
     */
    public function save(User $user, array $data): Process
    {
        $data['remark'] ??= '';
        if (empty($data['id'])) {
            $data['enterprise_id'] = $user->enterprise_id;
            return Process::create($data);
        } else {
            $process = $this->getProcess($user, $data['id']);
            $process->update($data);
            return $process;
        }
    }

    public function delete(User $user, int $id): void
    {
        $this->getProcess($user, $id)->delete();
    }

    public function getProcess(User $user, int $id): Process
    {
        return Process::where('id', $id)
            ->where('enterprise_id', $user->enterprise_id)
            ->firstOrFail();
    }
}
