<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClosedTradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('closed_trades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->biginteger('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->bigInteger('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->float('price');
            $table->integer('quantity');
            $table->string('other_details')->nullable();
            $table->boolean('has_customer_paid')->default(false);
            $table->boolean('are_goods_sent')->default(false);
            $table->boolean('are_goods_approved')->default(false);
            $table->enum('status',['failed','successful','processing']);
            $table->float('rating');
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
        Schema::dropIfExists('closed_trades');
    }
}
