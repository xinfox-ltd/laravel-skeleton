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
        Schema::create('planting_plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('enterprise_id')->default(0)->comment('企业ID');
            $table->unsignedBigInteger('production_base_id')->default(0)->comment('基地ID');
            $table->unsignedBigInteger('product_id')->default(0)->comment('产出产品');
            $table->string('name', 128)->default('')->comment('计划名称');
            $table->unsignedBigInteger('user_id')->default(0)->comment('负责人ID');
            $table->date('end_date')->nullable()->comment('计划结束时间');
            $table->unsignedTinyInteger('status')->default(0)->comment('状态：1进行中 10已结束');
            $table->timestamps();
            $table->index('enterprise_id');
            $table->index('production_base_id');
            $table->index('user_id');
            $table->comment('种植计划');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planting_plans');
    }
};
