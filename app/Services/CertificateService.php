<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Services;

use App\Models\Certificate;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CertificateService
{
    public function list(User $user, array $params): LengthAwarePaginator
    {
        return Certificate::when(
            $user->enterprise_id > 0 ? $user->enterprise_id : null,
            function ($query, $enterpriseId) {
                $query->where('enterprise_id', $enterpriseId);
            }
        )
            ->when($params['keyword'] ?? null, function ($query, $keyword) {
                $query->where('name', 'LIKE', "%$keyword%");
            })
            ->paginate($params['page_size'] ?? 20);
    }

    public function save(array $data)
    {
        if (is_string($data['scan_file'])) {
            $data['scan_file'] = explode(',', $data['scan_file']);
        }
        if (empty($data['id'])) {
            return Certificate::create($data);
        } else {
            $certificate = Certificate::findOrFail($data['id']);
            $certificate->update($data);
        }

        return $certificate;
    }

    public function delete(User $user, int $id): void
    {
        Certificate::where('enterprise_id', $user->enterprise_id)->findOrFail($id)->delete();
    }
}
