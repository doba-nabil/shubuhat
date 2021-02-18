<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            /***** (registe / login) info ********/
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('verified')->default(false);
            $table->string('password')->nullable();
            $table->string('phone')->nullable();
            /*********** local info ************/
            $table->string('name');
            $table->string('social_status')->nullable();
            $table->string('religion')->nullable();
            $table->enum('gender' , ['ذكر' , 'أنثى'])->nullable();
            $table->tinyInteger('active')->default(1);
            $table->tinyInteger('terms')->default(0);
            $table->tinyInteger('complete')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
