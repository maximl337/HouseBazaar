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
            $table->integer('price')->nullable();
            $table->text('description');
            $table->decimal('bedrooms', 2, 1)->unsigned();
            $table->decimal('bathrooms', 2, 1)->unsigned();
            $table->decimal('size_square_feet', 10, 2)->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('contact_phone_1')->nullable();
            $table->string('contact_phone_2')->nullable();
            $table->string('contact_email')->nullable();
            $table->boolean('allow_comments')->default(true);
            $table->string('transaction_type');
            $table->string('seller_type');
            $table->string('property_type');
            $table->boolean('furnished')->default(false);
            $table->boolean('pets')->default(false);
            $table->boolean('sample')->default(false);
            $table->boolean('published')->default(false);
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
