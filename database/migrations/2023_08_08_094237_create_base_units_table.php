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
        Schema::create('base_units', function (Blueprint $table) {
            $table->id();
            $table->string('region_id')->default('')->comment('地区/乡镇ID');
            $table->string('name', 128)->default('')->comment('基地单元名称');
            $table->string('unit_no')->default('')->comment('基地单元编号');
            $table->string('director', 32)->default('')->comment('负责人');
            $table->string('phone', 64)->default('')->comment('联系电话');
            $table->smallInteger('village_num')->default(0)->comment('自然村数量');
            $table->unsignedInteger('farmer_num')->default(0)->comment('农户数量');
            $table->string('area', 128)->default('')->comment('面积');
            $table->timestamps();
            $table->comment('基地单元');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('base_units');
    }
};
