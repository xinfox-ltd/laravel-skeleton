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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 16)->comment('管理员名称');
            $table->string('username', 16)->default('')->comment('用户名');
            $table->bigInteger('phone')->default(0)->comment('手机');
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
