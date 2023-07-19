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
        Schema::create('production_bases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('enterprise_id')->default(0)->comment('企业ID');
            $table->unsignedTinyInteger('type')->default(0)
                ->comment('基地类型：1生产基地 2加工基地');
            $table->string('name', 128)->default('')->comment('基地名称');
            $table->string('base_no')->default('')->comment('基地编号');
            $table->string('director', 32)->default('')->comment('负责人');
            $table->string('phone', 64)->default('')->comment('联系电话');
            $table->string('region')->default('')->comment('地区');
            $table->smallInteger('village_num')->default(0)->comment('自然村数量');
            $table->unsignedInteger('farmer_num')->default(0)->comment('农户数量');
            $table->string('area', 128)->default('')->comment('面积');
            $table->decimal('lng', 9, 6)->default('0.000000')->comment('经度');
            $table->decimal('lat', 9, 6)->default('0.000000')->comment('维度');
            $table->json('images')->nullable()->comment('基地图片');
            $table->timestamps();
            $table->index('enterprise_id');
            $table->comment('生产/加工基地');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_bases');
    }
};
