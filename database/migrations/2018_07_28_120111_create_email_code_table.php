<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_code', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('email', '150')->default('')->comment('邮箱');
            $table->string('code', '10')->default('')->comment('验证码');
            $table->string('token', '100')->default('')->comment('token');
            $table->string('is_use', '5')->default('no')->comment('是否被使用，yes|no');
            $table->unique('token');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_code');
    }
}
