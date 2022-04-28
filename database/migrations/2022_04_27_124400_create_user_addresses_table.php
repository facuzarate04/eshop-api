<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('city_id');
            $table->string('street');
            $table->integer('street_number')->nullable()->default(null);
            $table->integer('flat')->nullable()->default(null);
            $table->integer('flat_number')->nullable()->default(null);
            $table->tinyText('references')->nullable()->default(null);

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('city_id')->references('id')->on('state_cities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_addresses');
    }
};
