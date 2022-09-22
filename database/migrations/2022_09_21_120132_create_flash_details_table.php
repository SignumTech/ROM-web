<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlashDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flash_details', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->bigInteger('flash_id')->unsigned();
            $table->foreign('flash_id')->references('id')->on('flash_sells')->onDelete('cascade');
            $table->bigInteger('p_id')->unsigned();
            $table->foreign('p_id')->references('id')->on('products')->onDelete('cascade');
            $table->integer('discount');
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
        Schema::dropIfExists('flash_details');
    }
}
