<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrimetrustTokenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('primetrust_token', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('token', 255)->comment('认证token');
            $table->dateTime('expiry')->comment('过期时间');
        });
        DB::statement("ALTER TABLE `primetrust_token` comment 'primetrust认证token记录表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('primetrust_token');
    }
}
