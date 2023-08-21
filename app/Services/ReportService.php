<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Services;

use App\Models\RawMaterial;
use App\Models\Report;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class ReportService
{
    public function list(User $user, array $params): LengthAwarePaginator
    {
        return Report::where('reports.enterprise_id', $user->enterprise_id)
            ->leftJoin('enterprise_products', 'enterprise_products.id', '=', 'reports.enterprise_product_id')
            ->leftJoin('products', 'products.id', '=', 'enterprise_products.product_id')
            ->select(['reports.*', 'products.name as product_name'])
            ->when($params['keyword'] ?? null, function ($query, $keyword) {
                $query->where('reports.name', 'LIKE', "%$keyword%");
            })
            ->orderBy('reports.id', 'DESC')
            ->paginate($params['page_size'] ?? 20);
    }

    public function save(User $user, array $data)
    {
        $data['remark'] ??= '';
        $data['enterprise_id'] = $user->enterprise_id;
        if (empty($data['id'])) {
            return Report::create($data);
        } else {
            $report = $this->getReport($user, $data['id']);
            $report->name = $data['name'];
            $report->enterprise_product_id = $data['enterprise_product_id'];
            $report->detection_type = $data['detection_type'];
            $report->detection_institution = $data['detection_institution'];
            $report->is_qualified = $data['is_qualified'];
            $report->report_date = $data['report_date'];
            $report->remark = $data['remark'];
            $report->scan_file = $data['scan_file'];
            $report->save();
            return $report;
        }
    }

    public function delete(User $user, int $id): void
    {
        $this->getReport($user, $id)->delete();
    }

    public function getReport(User $user, int $id): Report
    {
        return Report::where('id', $id)
            ->with(['enterpriseProduct', 'enterpriseProduct.product'])
            ->where('enterprise_id', $user->enterprise_id)
            ->firstOrFail();
    }
}
