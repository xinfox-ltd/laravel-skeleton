<?php

namespace App\Jobs;

use App\Models\TraceabilityCode;
use App\Models\TraceabilityCodeApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class GenerateTraceabilityCode implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public TraceabilityCodeApplication $codeApplication)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(Application $app): void
    {
        $codeApplication = $this->codeApplication;
        if ($codeApplication->grant_quantity > 0) {
            $prefix = str_pad((string)$codeApplication->id, 8, '0', STR_PAD_LEFT);
            $date = Carbon::now();
            for ($i = 1; $i <= $codeApplication->grant_quantity; $i++) {
                $no = str_pad((string)$i, 5, '0', STR_PAD_LEFT);

                $data[] = [
                    'serial_number' => $prefix . $no,
                    'code' => $app->snowflake->id(),
                    'effective_day' => 500,
                    'enterprise_id' => $codeApplication->enterprise_id,
                    'created_at' => $date,
                    'status' => 1,
                ];

                if (count($data) >= 100 || $i == $codeApplication->grant_quantity) {
                    TraceabilityCode::insert($data);
                    $data = [];
                }
            }
        }
    }
}
