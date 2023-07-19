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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('enterprise_id')->default(0)->comment('企业ID');
            $table->string('name')->comment('供应商名称');
            $table->string('contact', 128)->default('')->comment('联系人');
            $table->string('telephone', 32)->default('')->comment('联系电话');
            $table->string('remark')->default('')->comment('描述');
            $table->timestamps();
            $table->index('enterprise_id');
            $table->comment('供应商');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
