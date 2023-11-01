<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('channels', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('enterprise_id')->default(0)->comment('企业ID');
            $table->unsignedTinyInteger('type')->comment('渠道类型：1网店 2实体店 3电话联系');
            $table->string('name')->comment('渠道名称');
            $table->json('data')->nullable()->comment('渠道数据');
            $table->timestamps();
            $table->comment('销售渠道');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('channels');
    }
};
