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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128)->default('')->comment('产品名称');
            $table->json('images')->nullable()->comment('产品图片');
            $table->string('origin', 128)->default('')->comment('产地');
            $table->text('intro')->nullable()->comment('产品介绍');
            $table->timestamps();
            $table->comment('产品');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
