<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Services;

use App\Models\BaseUnit;
use App\Models\Report;
use Illuminate\Pagination\LengthAwarePaginator;

class BaseUnitService
{
    public function list(array $params): LengthAwarePaginator
    {
        return BaseUnit::when($params['keyword'] ?? null, function ($query, $keyword) {
                $query->where('name', 'LIKE', "%$keyword%");
            })
            ->orderBy('id', 'DESC')
            ->paginate($params['page_size'] ?? 20);
    }

    public function save(array $data)
    {
        $data['remark'] ??= '';
        if (empty($data['id'])) {
            return Report::create($data);
        } else {
            $report = $this->getBaseUnit($data['id']);
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

    public function delete(int $id): void
    {
        $this->getBaseUnit($id)->delete();
    }

    public function getBaseUnit(int $id): BaseUnit
    {
        return BaseUnit::findOrFail($id);
    }
}
