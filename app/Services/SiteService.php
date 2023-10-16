<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Certificate;
use App\Models\Enterprise;
use App\Models\EnterpriseProduct;
use App\Models\Product;
use App\Models\TraceabilityCode;

class SiteService
{
    /**
     * @param int $id
     * @return array[]
     */
    public function getTraceabilityCode(int $id): array
    {
        $traceabilityCode = TraceabilityCode::where('id', $id)->firstOrFail();

        $enterpriseProduct = EnterpriseProduct::with(['trademark'])
            ->findOrFail($traceabilityCode->enterprise_product_id);

        $trademark = $enterpriseProduct->trademark;

        $product = Product::findOrFail($enterpriseProduct->product_id);
        $enterprise = Enterprise::findOrFail($enterpriseProduct->enterprise_id);

        $certificate = Certificate::where('enterprise_id', $enterpriseProduct->enterprise_id)->select();

        return [
            'product' => [
                'name' => $product->name,
                'trademark' => $trademark?->name ?? '未注册',
                'producer' => '',
                'enterprise' => $enterprise->name
            ],
            'batch' => [
                'pick_date' => '',
                'serial_number' => $traceabilityCode->serial_number,
            ],
            'certificate' => $certificate
        ];
    }
}
