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
        Schema::create('planting_assignments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('planting_plan_id')->default(0)->comment('种植计划ID');
            $table->string('assignment_content', 128)->default('')->comment('作业名称');
            $table->date('start_date')->nullable()->comment('作业开始时间');
            $table->date('end_date')->nullable()->comment('作业结束时间');
            $table->timestamps();
            $table->comment('种植作业');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planting_assignments');
    }
};
