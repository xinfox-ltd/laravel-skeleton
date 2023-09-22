<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Services;

use App\Models\Trademark;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TrademarkService
{
    public function list($params = [])
    {
        $query = Trademark::when($params['enterprise_id'] ?? null, function ($query, $enterpriseId) {
            $query->where('enterprise_id', $enterpriseId);
        })
            ->orderBy('id', 'DESC');

        if (isset($params['simple'])) {
            return $query->get();
        }

        return $query->paginate($params['page_size'] ?? 10);
    }

    /**
     * @param array $data
     * @return Trademark
     */
    public function save(array $data): Trademark
    {
        $data['icd'] ??= '';
        $data['awarding_bodies'] ??= '';

        if (empty($data['id'])) {
            return Trademark::create($data);
        } else {
            $product = Trademark::findOrFail($data['id']);
            $product->update($data);
            return $product;
        }
    }
}
