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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->unique();
            $table->string('status');
            $table->unsignedBigInteger('sub_category_id');
            $table->decimal('price', 10,2);
            $table->integer('stock')->default(0);
            $table->string('description',250)->nullable()->default(null);
            $table->decimal('weight',4,2)->nullable()->default(null);
            $table->decimal('width', 4,2)->nullable()->default(null);
            $table->decimal('height', 4,2)->nullable()->default(null);
            $table->string('color')->nullable()->default(null);
            $table->foreign('sub_category_id')->references('id')->on('sub_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
