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
        Schema::create('traceability_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code', 32)->default('')->comment('验证码');
            $table->bigInteger('enterprise_id')->default(0)->comment('企业ID');
            $table->unsignedInteger('effective_day')->default(0)->comment('有效天数');
            $table->date('enable_date')->nullable()->comment('启用日期');
            $table->date('expire_date')->nullable()->comment('失效日期');
            $table->unsignedInteger('scan_num')->default(0)->comment('扫码次数');
            $table->unsignedTinyInteger('status')
                ->default(0)->comment('状态：1未启用 2已废弃 10已启用');
            $table->timestamps();
            $table->index('code');
            $table->index('enterprise_id');
            $table->comment('溯源码');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('traceability_codes');
    }
};
