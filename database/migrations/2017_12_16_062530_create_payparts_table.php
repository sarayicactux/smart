<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaypartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payparts', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('user_id')->default(1);
            $table->integer('amount');
            $table->text('description');
            $table->string('pay_time');
            $table->string('pay_date');
            $table->string('tran_id')->unique();
            $table->string('tracking_code')->unique();
            $table->integer('partner_id')->unsigned();
            $table->foreign('partner_id')->references('id')->on('partners');
            $table->integer('payrq_id')->unsigned();
            $table->foreign('payrq_id')->references('id')->on('payrqs');
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
        Schema::dropIfExists('payparts');
    }
}
