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
        Schema::create('discount_items', function (Blueprint $table) {
            $table->id();
            $table->string('category_name');
            $table->string('name');
            $table->integer('normal_price');
            $table->integer('discount_price');
            $table->string('sim')->nullable();
            $table->string('storage')->nullable();
            $table->string('processor')->nullable();
            $table->string('size')->nullable();
            $table->longText('description');
            $table->string('image');
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
        Schema::dropIfExists('discount_items');
    }
};
