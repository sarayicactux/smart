<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayrqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payrqs', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('user_id')->default(1);
            $table->integer('amount');
            $table->text('description');
            $table->text('m_resp');
            $table->smallInteger('last_status')->default(0);
            $table->integer('partner_id')->unsigned();
            $table->foreign('partner_id')->references('id')->on('partners');
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
        Schema::dropIfExists('payrqs');
    }
}
