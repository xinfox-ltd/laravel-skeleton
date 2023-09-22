<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Services;

use App\Models\EnterpriseProduct;
use Illuminate\Pagination\LengthAwarePaginator;

class EnterpriseProductService
{
    public function list(array $params): LengthAwarePaginator
    {
        return EnterpriseProduct::join('products', 'products.id', '=', 'enterprise_products.product_id')
            ->select(['enterprise_products.*', 'products.name as product_name'])
            ->with(['trademark'])
            ->when($params['keyword'] ?? null, function ($query, $keyword) {
                $query->where('products.name', 'LIKE', "%$keyword%");
            })
            ->orderBy('enterprise_products.id', 'DESC')
            ->paginate($params['page_size'] ?? 20);
    }

    public function save(array $data): EnterpriseProduct
    {
        if (empty($data['id'])) {
            return EnterpriseProduct::create($data);
        } else {
            $enterpriseProduct = EnterpriseProduct::findOrFail($data['id']);
            $enterpriseProduct->update($data);
            return $enterpriseProduct;
        }
    }

    public function delete(int $id): void
    {
        EnterpriseProduct::findOrFail($id)->delete();
    }
}
