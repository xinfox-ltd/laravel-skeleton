<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Certificate;
use App\Models\Channel;
use App\Models\Enterprise;
use App\Models\EnterpriseProduct;
use App\Models\Product;
use App\Models\TraceabilityCode;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SiteService
{
    /**
     * @param int $id
     * @return array[]
     */
    public function getTraceabilityCode(int $id): array
    {
        $traceabilityCode = TraceabilityCode::where('id', $id)->firstOrFail();

        $enterpriseProduct = EnterpriseProduct::with(['trademark', 'product'])
            ->findOrFail($traceabilityCode->enterprise_product_id);

        $trademark = $enterpriseProduct->trademark;

        $product = $enterpriseProduct->product;
        $enterprise = Enterprise::findOrFail($enterpriseProduct->enterprise_id);

        $certificates = Certificate::where('enterprise_id', $enterpriseProduct->enterprise_id)->select();

        $saleChannels = Channel::where('enterprise_id', $enterprise->id)->select();

        return [
            'product' => [
                'name' => $product->name,
                'image' => $product->images[0],
                'trademark' => $trademark?->name ?? '未注册',
                'origin' => $product->origin,
                'enterprise' => $enterprise,
            ],
            'batch' => [
                'pick_date' => '',
                'serial_number' => $traceabilityCode->serial_number,
            ],
            'certificates' => $certificates,
            'sale_channels' => $saleChannels
        ];
    }

    public function traceabilityCodeQuery(int $traceabilityCodeId, $endNumber): TraceabilityCode|array|null
    {
        $traceabilityCode = TraceabilityCode::find($traceabilityCodeId);
        if ($traceabilityCode && str_ends_with($traceabilityCode->serial_number, $endNumber)) {
            $traceabilityCode->scan_num = DB::raw('scan_num+1');
            if (empty($traceabilityCode->first_query_time)) {
                $traceabilityCode->first_query_time = Carbon::now();
            }
            $traceabilityCode->update();
            return $traceabilityCode;
        }

        return null;
    }
}
