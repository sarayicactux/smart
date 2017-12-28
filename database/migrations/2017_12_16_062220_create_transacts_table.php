<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transacts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('amount');
            $table->string('tran_id')->unique();
            $table->string('tracking_code')->unique();
            $table->smallInteger('pay_type');
            $table->integer('url_id')->unsigned();
            $table->foreign('url_id')->references('id')->on('urls');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transacts');
    }
}
