<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('family');
            $table->string('tel');
            $table->string('mobile')->unique();
            $table->string('password');
            $table->smallInteger('pro_id');
            $table->smallInteger('city_id');
            $table->text('addr');
            $table->string('p_code');
            $table->integer('url_id')->unsigned();
            $table->foreign('url_id')->references('id')->on('urls');
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
        Schema::dropIfExists('customers');
    }
}
