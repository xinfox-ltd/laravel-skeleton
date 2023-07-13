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
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128)->default('')->comment('证书名称');
            $table->unsignedInteger('type')->default(0)->comment('证书类型');
            $table->string('certificate_no')->default('')->comment('证书编号');
            $table->string('authority')->default('')->comment('颁发机构');
            $table->string('scan_file')->default('')->comment('扫描件');
            $table->timestamps();
            $table->comment('证书');
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
