<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('mini_question');
            $table->string('mini_answer')->nullable();
            $table->string('sources')->nullable();
            $table->tinyInteger('active')->default(1);
            $table->Integer('views')->default(0);
            $table->Integer('answered')->default(0);
            $table->Integer('user_id')->nullable();
            $table->Integer('moderator_id')->nullable();
            $table->string('slug')->nullable();
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
        Schema::dropIfExists('questions');
    }
}
