<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRedeemOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('redeem_order', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('redeem_id', '64')->default('')->comment('订单号');
            $table->string('redeem_status', 10)->default('no')->comment('订单是否完成 yes|no');
            $table->string('redeem_currency', 10)->comment('订单货币');
            $table->string('redeem_amount', 10)->comment('订单金额');
            $table->string('token_name', 10)->comment('token名称');
            $table->string('token_amount', 10)->comment('token数量');
            $table->string('bank_account', 100)->comment('赎回银行账户');
            $table->string('bank_account_bsb', 10)->comment('赎回银行BSB');
            $table->string('bank_account_nmae', 10)->comment('赎回银行账户姓名');
            $table->string('redeem_fee', 10)->comment('赎回费');
            $table->string('redeem_rate', 10)->comment('赎回率');
            $table->string('dcp_in_return', 10)->comment('返还积分');
        });
        DB::statement("ALTER TABLE `redeem_order` comment '赎回订单表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('redeem_order');
    }
}
