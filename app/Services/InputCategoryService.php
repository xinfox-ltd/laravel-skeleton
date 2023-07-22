<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Services;

use App\Models\InputCategory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class InputCategoryService
{
    public function list(array $params): LengthAwarePaginator|Collection
    {
        $query = InputCategory::when($params['keyword'] ?? null, function ($query, $keyword) {
            $query->where('name', 'LIKE', "%$keyword%");
        })->orderBy('id', 'desc');

        $pagination = !isset($params['pagination']);
        return $pagination ? $query->paginate($params['page_size'] ?? 20) : $query->get();
    }

    public function save(array $data)
    {
        $data['remark'] ??= '';
        if (empty($data['id'])) {
            return InputCategory::create($data);
        } else {
            $category = InputCategory::findOrFail($data['id']);
            $category->update($data);
        }

        return $category;
    }

    public function delete(int $id): void
    {
        InputCategory::findOrFail($id)->delete();
    }
}
