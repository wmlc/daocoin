<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayMethodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_method', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('uid')->comment('用户id');
            $table->string('ach_check_type', 255)->comment('持卡人类型,personal或business');
            $table->string('bank_account_name', 255)->comment('账户名称');
            $table->string('bank_account_type', 255)->comment('账户类型');
            $table->string('bank_account_number', 255)->comment('银行卡号');
            $table->string('contact_email', 255)->comment('联系人邮箱');
            $table->string('contact_name', 255)->comment('联系人姓名');
            $table->string('intermediary_bank_name', 255)->comment('国际电汇上的中间银行的名称。');
            $table->string('intermediary_bank_reference', 255)->comment('中间银行在国际电汇上要求的特殊参考信息。');
            $table->string('payment_type', 255)->comment('支付方式，ach，check，credit-card，wire或wire-international');
            $table->string('routing_number', 255)->comment('美国银行的路由号码。');
            $table->string('swift_code', 255)->comment('用于国际电线的SWIFT代码。');
            $table->string('bank_name', 255)->comment('持有给制定账户名称');
            $table->string('payment_method_id', 255)->default('')->comment('付款方式id');
            $table->unique('uid');
        });
        DB::statement("ALTER TABLE `payment_method` comment '用户支付方式设置表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_method');
    }
}
