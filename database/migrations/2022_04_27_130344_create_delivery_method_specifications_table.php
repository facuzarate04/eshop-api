<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('delivery_method_specifications', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('delivery_method_id');
            $table->unsignedBigInteger('origin_id');
            $table->unsignedBigInteger('destination_id');
            $table->decimal('price');
            $table->integer('delay_time')->default(0);

            $table->foreign('delivery_method_id')->references('id')->on('delivery_methods');
            $table->foreign('origin_id')->references('id')->on('state_cities');
            $table->foreign('destination_id')->references('id')->on('state_cities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_method_specifications');
    }
};
