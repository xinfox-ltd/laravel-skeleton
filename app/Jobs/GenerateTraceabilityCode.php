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
            for ($i = 1; $i <= $codeApplication->grant_quantity; $i ++) {
                $traceabilityCode = new TraceabilityCode();
                $traceabilityCode->serial_number = "";
                $traceabilityCode->code = $app->snowflake->id();
                $traceabilityCode->enterprise_id = $codeApplication->enterprise_id;
                $traceabilityCode->save();
            }
        }
    }
}
