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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('enterprise_id')->default(0)->comment('企业ID');
            $table->bigInteger('enterprise_product_id')->default(0)->comment('企业产品ID');
            $table->string('name', 128)->default('')->comment('包装名称');
            $table->string('spec')->default('')->comment('规格');
            $table->json('images')->nullable()->comment('包装图片');
            $table->timestamps();
            $table->index('enterprise_id');
            $table->comment('包装');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
