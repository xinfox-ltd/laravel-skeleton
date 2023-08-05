<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Services;

use App\Models\Package;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class PackageService
{
    public function list(User $user, array $params = []): LengthAwarePaginator
    {
        return Package::where('packages.enterprise_id', $user->enterprise_id)
            ->leftJoin('enterprise_products', 'enterprise_products.id', '=', 'packages.enterprise_product_id')
            ->leftJoin('products', 'products.id', '=', 'enterprise_products.product_id')
            ->select(
                [
                    'packages.*',
                    'products.name as enterprise_product_name',
                ]
            )
            ->when($params['keyword'] ?? null, function ($query, $keyword) {
                $query->where('packages.name', 'LIKE', "%$keyword%");
            })
            ->orderBy('packages.id', 'DESC')
            ->paginate($params['page_size'] ?? 10);
    }

    /**
     * @param User $user
     * @param array $data
     * @return Package
     */
    public function save(User $user, array $data): Package
    {
        $data['spec'] ??= '';
        if (empty($data['id'])) {
            $data['enterprise_id'] = $user->enterprise_id;
            return Package::create($data);
        } else {
            $package = $this->getPackage($user, $data['id']);
            $package->update($data);
            return $package;
        }
    }

    public function delete(User $user, int $id): void
    {
        $this->getPackage($user, $id)->delete();
    }

    public function getPackage(User $user, int $id): Package
    {
        return Package::where('id', $id)
            ->where('enterprise_id', $user->enterprise_id)
            ->firstOrFail();
    }
}
