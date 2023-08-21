<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('enterprise_id')->default(0)->comment('企业ID');
            $table->string('name')->comment('报告名称');
            $table->unsignedBigInteger('enterprise_product_id')->default(0)->comment('产品ID');
            $table->string('detection_type', 64)->default('')->comment('检测类型');
            $table->string('detection_institution', 128)->default('')->comment('检测机构');
            $table->boolean('is_qualified')->default(true)->comment('是否合格');
            $table->date('report_date')->nullable()->comment('报告日期');
            $table->string('remark')->default('')->comment('结果说明');
            $table->json('scan_file')->nullable()->comment('检测扫描件');
            $table->timestamps();
            $table->index('enterprise_id');
            $table->index('enterprise_product_id');
            $table->comment('检测报告');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
