<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('street');
            $table->string('city', 40);
            $table->string('zip', 10);
            $table->string('country', 40);
            $table->string('state', 40);
            $table->integer('price');
            $table->text('description');
            $table->timestamps();
        });

        Schema::table('properties', function (Blueprint $table) {

            $table->foreign('user_id')
                    ->references('id')
                    ->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('properties');
    }
}