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
        Schema::create('production_base_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('production_base_id')->comment('基地ID');
            $table->unsignedBigInteger('enterprise_staff_id')->default(0)->comment('负责人ID');
            $table->string('name', 128)->comment('车间/地块名称');
            $table->string('regional_location')->default('')->comment('区域位置');
            $table->string('area', 128)->default('')->comment('面积');
            $table->decimal('lng', 9, 6)->default('0.000000')->comment('经度');
            $table->decimal('lat', 9, 6)->default('0.000000')->comment('维度');
            $table->string('remark')->default('')->comment('备注/说明');
            $table->timestamps();
            $table->comment('基地地块/车间');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_base_items');
    }
};
