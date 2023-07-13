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
        Schema::create('harvest_plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('planting_plan_id')->default(0)->comment('种植计划');
            $table->unsignedBigInteger('raw_material_id')->default(0)->comment('原料/等级');
            $table->string('name', 128)->default('')->comment('计划名称');
            $table->date('start_date')->nullable()->comment('计划开始时间');
            $table->date('end_date')->nullable()->comment('计划结束时间');
            $table->string('remark')->default('')->comment('备注');
            $table->timestamps();
            $table->comment('原料采收计划');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('harvest_plans');
    }
};
