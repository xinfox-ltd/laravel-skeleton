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
        Schema::create('planting_assignment_input', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('planting_assignment_id')->default(0)->comment('作业ID');
            $table->unsignedBigInteger('input_id')->default(0)->comment('投入品ID');
            $table->string('quantity', 16)->default('')->comment('使用量');
            $table->string('unit_type', 16)->default('')->comment('计量单位类型：1每亩 2每平方 3每立方米 4稀释倍数');
            $table->unsignedBigInteger('unit_id', 16)->default('')->comment('计量单位');
            $table->string('method', 64)->default('')->comment('使用方法');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planting_assignment_input');
    }
};
