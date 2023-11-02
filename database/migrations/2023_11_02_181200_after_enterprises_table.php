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
        Schema::table('enterprises', function (Blueprint $table) {
            $table->decimal('lng', 9, 6)
                ->default('0.000000')->comment('经度')->after('intro');
            $table->decimal('lat', 9, 6)
                ->default('0.000000')->comment('维度')->after('lng');
            $table->string('business_license')->default('')
                ->comment('营业执照')->after('lat');
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
