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
        Schema::create('processes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('enterprise_id')->default(0)->comment('企业ID');
            $table->string('name', 128)->default('')->comment('加工类型/方式名称');
            $table->unsignedBigInteger('process_flow_id')->default(0)->comment('加工流程/工艺');
            $table->unsignedBigInteger('enterprise_product_id')->default(0)->comment('输出产品（企业产品ID）');
            $table->unsignedBigInteger('production_base_id')->default(0)->comment('加工基地');
            $table->timestamps();
            $table->index('enterprise_id');
            $table->comment('产品加工');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('processes');
    }
};
