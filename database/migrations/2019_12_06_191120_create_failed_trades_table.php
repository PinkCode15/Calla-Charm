<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFailedTradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('failed_trades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->biginteger('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->bigInteger('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->bigInteger('closed_trade_id')->unsigned();
            $table->foreign('closed_trade_id')->references('id')->on('closed_trades')->onDelete('cascade');
            $table->enum('stage_failed',['stage 0','stage 1','stage 2','stage 3']);
            $table->boolean('are_goods_returned');
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
        Schema::dropIfExists('failed_trades');
    }
}
