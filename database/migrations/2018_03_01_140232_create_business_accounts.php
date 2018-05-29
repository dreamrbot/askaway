<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('business_accounts', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');
          $table->text('address');
          $table->string('country');
          $table->string('tax_number');
          $table->string('phone_number');
          $table->double('credit');
          $table->timestamps();

          $table->integer('user_id')->unsigned();
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_accounts');
    }
}
