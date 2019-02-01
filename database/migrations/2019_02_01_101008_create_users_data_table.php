<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_data', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id')->unique();
            $table->text('about')->nullable();
            $table->text('language')->nullable();
            $table->text('contact')->nullable();
            $table->text('other_contact')->nullable();
            $table->string('avatar')->nullable();
            $table->text('services')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('time_to_call')->nullable();
            $table->text('user_files')->nullable();
            $table->text('properties')->nullable();
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
        Schema::dropIfExists('users_data');
    }
}
