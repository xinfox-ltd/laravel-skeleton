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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('type')
                ->default(1)
                ->comment('用户类型 1系统管理员 2企业管理账户');
            $table->unsignedBigInteger('company_id')->default(0)->comment('企业ID');
            $table->string('name', 16)->comment('管理员名称');
            $table->string('username', 16)->default('')->comment('用户名');
            $table->bigInteger('phone')->default(0)->comment('手机');
            $table->string('office_phone', 128)->default('')->comment('办公电话');
            $table->string('email')->default('')->comment('电子邮箱');
            $table->string('password', 128)->comment('密码');
            $table->rememberToken();
            $table->timestamps();
            $table->comment('用户表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
