<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFolderFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('folder_files', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->bigInteger('folder_id')->unsigned()->index();
            $table->foreign('folder_id')->references('id')->on('folders')->onDelete('cascade');
            /*** id by kind **************************************************/
            /* articles - videos - audios */
            $table->bigInteger('media_id')->unsigned()->index()->nullable();
            $table->foreign('media_id')->references('id')->on('media')->onDelete('cascade');
            /* questions */
            $table->bigInteger('question_id')->unsigned()->index()->nullable();
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            /*** end id by kind**************************************************/
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
        Schema::dropIfExists('folder_files');
    }
}
