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
        Schema::create('enterprise_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('enterprise_id')->comment('企业ID');
            $table->unsignedBigInteger('product_id')->comment('产品ID');
            $table->unsignedBigInteger('trademark_id')->comment('商标ID');
            $table->timestamps();
            $table->index('enterprise_id');
            $table->index('product_id');
            $table->index('trademark_id');
            $table->comment('企业产品');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enterprise_products');
    }
};
