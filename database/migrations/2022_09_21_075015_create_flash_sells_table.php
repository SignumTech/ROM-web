<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlashSellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flash_sells', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->bigInteger('p_id')->unsigned();
            $table->foreign('p_id')->references('id')->on('products')->onDelete('cascade');
            $table->bigInteger('cat_id')->unsigned();
            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('cascade');
            $table->integer('discount');
            $table->dateTime('expiry_date');
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
        Schema::dropIfExists('flash_sells');
    }
}
