<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->enum('user_type',['customer','vendor']);
            $table->enum('transaction_type',['debit','credit']);
            $table->bigInteger('closed_trade_id')->unsigned()->nullable();
            $table->foreign('closed_trade_id')->references('id')->on('closed_trades')->onDelete('cascade');
            $table->enum('description',['Calla Charm: Wallet Deposit From You',
                                        'Calla Charm: Wallet Deposit From Customer',
                                        'Calla Charm: Wallet Withdraw In-App',
                                        'Calla Charm: Wallet Withdraw Out-Of-App']);
            $table->float('amount');
            $table->float('charge')->default(0);
            $table->float('total_amount');
            $table->string('reference');
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
        Schema::dropIfExists('transactions');
    }
}
