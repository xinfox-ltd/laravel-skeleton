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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128)->default('')->comment('企业名称');
            $table->unsignedTinyInteger('type')->default(0)
                ->comment('企业类型 1国家级龙头企业 2自治区级龙头企业 3市级龙头企业 4其他企业');
            $table->string('phone', 32)->default('')->comment('联系电话');
            $table->string('address')->default('')->comment('企业地址');
            $table->json('products')->nullable()->comment('产品');
            $table->unsignedTinyInteger('status')->default(0)
                ->comment('审核状态 1待审核 10审核通过');
            $table->timestamp('audited_at')->nullable()->comment('审核时间');
            $table->timestamps();
            $table->comment('企业');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
