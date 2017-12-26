<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('prod_id')->default(1);
            $table->string('addr');
            $table->string('p_code');
            $table->string('tel');
            $table->integer('count');
            $table->string('order_time');
            $table->string('order_date');
            $table->smallInteger('pro_id');
            $table->smallInteger('city_id');
            $table->smallInteger('last_status')->default();
            $table->integer('url_id')->unsigned();
            $table->foreign('url_id')->references('id')->on('urls');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers');
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
        Schema::dropIfExists('orders');
    }
}
