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
        Schema::create('dosage_forms', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128)->default('')->comment('名称');
            $table->unsignedBigInteger('input_category_id')->default(0)->comment('类别');
            $table->string('remark')->default('')->comment('备注');
            $table->timestamps();
            $table->comment('剂型');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosage_forms');
    }
};
