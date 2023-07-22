<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Services;

use App\Models\DosageForm;
use Illuminate\Pagination\LengthAwarePaginator;

class DosageFormService
{
    public function list(array $params): LengthAwarePaginator
    {
        return DosageForm::with('category')
            ->when($params['category_id'] ?? null, function($query, $categoryId) {
                $query->where('input_category_id', $categoryId);
            })
            ->when($params['keyword'] ?? null, function($query, $keyword) {
                $query->where('name', 'LIKE', "%$keyword%");
            })
            ->paginate($params['page_size'] ?? 20);
    }

    public function save(array $data)
    {
        $data['remark'] ??= '';
        if (empty($data['id'])) {
            return DosageForm::create($data);
        } else {
            $dosageForm = DosageForm::findOrFail($data['id']);
            unset($data['id'], $data['created_at']);
            $dosageForm->update($data);
        }

        return $dosageForm;
    }
}
