<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Services;

use App\Models\Certificate;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CertificateService
{
    public function list(array $params): LengthAwarePaginator
    {
        return Certificate::when($params['keyword'] ?? null, function($query, $keyword) {
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
}
