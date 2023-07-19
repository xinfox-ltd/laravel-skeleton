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
        Schema::create('inputs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('enterprise_id')->default(0)->comment('企业ID');
            $table->unsignedTinyInteger('type')->default(0)->comment('类别：1农药 2化肥');
            $table->unsignedBigInteger('dosage_form_id')->default(0)->comment('剂型');
            $table->string('name', 128)->default('')->comment('名称');
            $table->unsignedBigInteger('supplier_id')->default(0)->comment('供应商ID，0为自制');
            $table->string('enterprise')->default('')->comment('生产企业');
            $table->string('registration_no')->default('')->comment('登记证号');
            $table->string('component')->default('')->comment('成分信息');
            $table->string('executive_standard')->default('')->comment('执行标准');
            $table->json('annex')->nullable()->comment('附件');
            $table->timestamps();
            $table->index('enterprise_id');
            $table->comment('生产投入品');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inputs');
    }
};
