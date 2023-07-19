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
        Schema::create('enterprise_staff', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('enterprise_id')->comment('企业');
            $table->string('name', 64)->comment('员工姓名');
            $table->string('phone', 128)->default('联系电话');
            $table->timestamps();
            $table->comment('企业员工');
            $table->index('enterprise_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enterprise_staff');
    }
};
