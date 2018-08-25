<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_order', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('uid')->comment('用户id');
            $table->string('order_id', '64')->default('')->comment('订单号');
            $table->string('order_status', 20)->default('no')->comment('订单是否完成 yes|no');
            $table->string('order_currency', 10)->comment('订单货币');
            $table->string('order_amount', 10)->comment('订单金额');
            $table->string('token_name', 10)->comment('token名称');
            $table->string('token_amount', 10)->comment('token数量');
            $table->string('wallet_address', 100)->comment('钱包地址');
            $table->string('purchase_fee', 10)->comment('购买费');
            $table->string('purchase_rate', 10)->comment('购买率');
            $table->string('dcp_in_return', 10)->comment('返还积分');
            $table->string('purchase_method', 10)->comment('购买方式，visa|ach|wire');
        });
        DB::statement("ALTER TABLE `purchase_order` comment '购买订单表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_order');
    }
}
