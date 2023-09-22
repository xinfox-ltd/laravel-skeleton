<?php
/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */

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
        Schema::table('enterprise_products', function (Blueprint $table) {
            $table->string('warranty_period')
                ->default('')
                ->after('trademark_id')
                ->comment('质保期');
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
