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
        Schema::create('trademarks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('enterprise_id')->comment('企业');
            $table->string('name')->comment('商标名称');
            $table->string('registration_no')->default('')->comment('注册号');
            $table->string('icd', 128)->default('')->comment('国际分类');
            $table->string('awarding_bodies', 128)->default('')->comment('颁证机构');
            $table->json('valid_date')->nullable()->comment('有效日期');
            $table->string('scan_file')->default('')->comment('扫描文件');
            $table->timestamps();
            $table->index('enterprise_id');
            $table->comment('商标');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trademarks');
    }
};
