<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('question_id')->nullable()->unsigned();
            $table->integer('answer_id')->nullable()->unsigned();
            $table->text('description')->nullable();
            $table->boolean('processed')->default(false);
            $table->string('video_id')->nullable();
            $table->string('video_filename')->nullable();
            $table->integer('processed_percentage')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->foreign('answer_id')->references('id')->on('answers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
