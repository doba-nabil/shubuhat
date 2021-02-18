<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->id();
            /************** main options ************/
            $table->string('title');
            $table->string('phone');
            $table->string('whatsapp');
            $table->string('email');
            $table->tinyInteger('active')->default(1);
            /*********** banner info *********/
            $table->string('banner_title');
            $table->string('banner_link');
            /************ footer text *************/
            $table->string('footer_text');
            /********* social ***************/
            $table->string('facebook')->nullable();
            $table->string('insta')->nullable();
            $table->string('youtube')->nullable();
            $table->string('twitter')->nullable();
            /*********** ad folders sections ***********/
            $table->string('folders_link')->nullable();
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
        Schema::dropIfExists('options');
    }
}
