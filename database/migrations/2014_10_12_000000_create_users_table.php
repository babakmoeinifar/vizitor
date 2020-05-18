<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id')->default(4);
            $table->unsignedBigInteger('category_id')->default(1);
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('name')->nullable();
            $table->string('mobile')->unique();
            $table->string('avatar')->nullable();
            $table->text('address')->nullable();
            $table->boolean('is_active')->default(false);
            $table->tinyInteger('code')->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->string('last_ip_login')->nullable();
            $table->timestamps();
            $table->timestamp('banned_at')->nullable();
            $table->softDeletes();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
