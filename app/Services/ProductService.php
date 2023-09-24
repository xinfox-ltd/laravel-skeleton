<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Services;

use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductService
{
    public function list(array $params = []): LengthAwarePaginator
    {
        return Product::orderBy('id', 'DESC')->paginate($params['page_size'] ?? 10);
    }

    /**
     * @param array $data
     * @return Product
     */
    public function save(array $data): Product
    {
        if (!empty($data['images']) && is_string($data['images'])) {
            $data['images'] = explode(',', $data['images']);
        }

        if (empty($data['id'])) {
            return Product::create($data);
        } else {
            $product = Product::findOrFail($data['id']);
            $product->update($data);
            return $product;
        }
    }
}
