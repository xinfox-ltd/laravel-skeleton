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
        Schema::create('process_flows', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('enterprise_id')->default(0)->comment('企业ID');
            $table->string('name', 128)->comment('流程名称');
            $table->json('steps')->nullable()->comment('工艺/步骤');
            $table->string('remark')->default('')->comment('备注');
            $table->timestamps();
            $table->index('enterprise_id');
            $table->comment('加工流程');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('process_flows');
    }
};
