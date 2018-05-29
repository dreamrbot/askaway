<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddScoresToAnswers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('answers', function (Blueprint $table) {
          $table->integer('score')->nullable();

      });
    }


    public function down()
    {
        Schema::dropIfExists('answers');
    }
}
