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
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('enterprise_id')->default(0)->comment('企业ID');
            $table->unsignedTinyInteger('type')->default(0)
                ->comment('证书类型：1地理标志认证 2企业资质 3产品认证');
            $table->unsignedTinyInteger('subtype')->default(0)
                ->comment('证书子类型：1无公害农产品 2绿色食品 3有机农产品 4富硒农产品');
            $table->string('name', 128)->default('')->comment('证书名称');
            $table->string('certificate_no')->default('')->comment('证书编号');
            $table->string('authority')->default('')->comment('颁发机构');
            $table->json('valid_date')->nullable()->comment('有效日期');
            $table->json('scan_file')->nullable()->comment('扫描件');
            $table->timestamps();
            $table->index('enterprise_id');
            $table->comment('认证证书');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
