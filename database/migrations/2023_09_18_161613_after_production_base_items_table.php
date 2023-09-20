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
        Schema::table('production_base_items', function (Blueprint $table) {
            $table->unsignedBigInteger('enterprise_id')->default(0)
                ->comment('企业ID')
                ->after('id');
            $table->tinyInteger('area_unit')->default(0)->comment('面积单位：1亩 2平方米')
                ->after('area');
            $table->unsignedBigInteger('base_unit_id')->default(0)->comment('基地单元')
                ->after('enterprise_staff_id');
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
