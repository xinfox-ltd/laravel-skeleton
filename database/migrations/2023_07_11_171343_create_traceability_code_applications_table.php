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
        Schema::create('traceability_code_applications', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id')->default(0)->comment('企业ID');
            $table->unsignedInteger('quantity')->default(0)->comment('申请数量');
            $table->unsignedTinyInteger('status')->default(0)
                ->comment('审核状态 1待审核 2审核不通过 10审核通过');
            $table->string('reason')->default('')->comment('不通过原因');
            $table->string('remark')->default('')->comment('备注');
            $table->timestamps();
            $table->index('company_id');
            $table->comment('溯源码申请');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('traceability_code_applications');
    }
};
