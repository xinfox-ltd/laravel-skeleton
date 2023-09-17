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
        Schema::table('traceability_code_applications', function (Blueprint $table) {
            $table->integer('grant_quantity')
                ->default(0)->comment('发放数量')
                ->after('quantity');
            $table->string('start_number')->default('')
                ->comment('起始编号')
                ->after('grant_quantity');
            $table->timestamp('audit_at')
                ->nullable()
                ->comment('审核时间')
                ->after('remark');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
