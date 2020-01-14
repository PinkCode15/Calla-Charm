<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone_number')->unique();
            $table->string('company_name')->unique();
            $table->string('password');
            $table->text('photo')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->float('rating')->nullable();
            $table->text('email_token')->nullable();
            $table->text('phone_token')->nullable();
            $table->boolean('is_email_verified')->default(false);
            $table->boolean('is_phone_number_verified')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('phone_number_verified_at')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('vendors');
    }
}
