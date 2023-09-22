<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('traceability_codes', function (Blueprint $table) {
            $table->unsignedBigInteger('enterprise_product_id')->default(0)
                ->comment('企业产品ID')
                ->after('enterprise_id');
            $table->unsignedBigInteger('harvest_plan_id')->default(0)
                ->comment('原料采收计划ID')
                ->after('enterprise_product_id');
            $table->unsignedBigInteger('report_id')->default(0)
                ->comment('检测报告ID')
                ->after('harvest_plan_id');
            $table->unsignedBigInteger('package_id')->default(0)
                ->comment('外包装规格ID')
                ->after('report_id');
            $table->unsignedBigInteger('process_id')->default(0)
                ->comment('加工类型ID')
                ->after('package_id');
            $table->unsignedBigInteger('production_base_item_id')->default(0)
                ->comment('种植地块ID')
                ->after('process_id');
            $table->date('process_start_date')->nullable()->comment('加工开始日期')
                ->after('expire_date');
            $table->date('process_end_date')->nullable()->comment('加工结束日期')
                ->after('process_start_date');
            $table->boolean('is_can_enabled')->default(false)->comment('是否可以启用')
                ->after('status');
            $table->timestamp('first_query_time')->nullable()->comment('首次查询时间')
                ->after('is_can_enabled');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
