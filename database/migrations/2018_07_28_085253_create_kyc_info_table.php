<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKycInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kyc_info', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('uid')->comment('用户id');
            $table->string('nationality', '100')->default('')->comment('国家');
            $table->string('first_name', '100')->default('')->comment('First name');
            $table->string('middle_name', '100')->default('')->comment('Middle name');
            $table->string('family_name', '100')->default('')->comment('Family name');
            $table->date('birth')->comment('生日');
            $table->string('certificate_type', '100')->default('')->comment('证件类型');
            $table->string('certificate_id', '100')->default('')->comment('证件号');
            $table->date('certificate_expiry_date')->comment('证件有效期');
            $table->string('address', '150')->default('')->comment('居住地址');
            $table->string('certificate', '255')->default('')->comment('证件照片');
            $table->string('proof_address', '255')->default('')->comment('地址证明照片');
            $table->string('is_pass', '10')->default('no')->comment('是否通过认证，yes|no');
            $table->unique('uid');
        });
        DB::statement("ALTER TABLE `kyc_info` comment 'kyc验证信息表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kyc_info');
    }
}
