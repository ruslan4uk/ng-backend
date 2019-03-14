<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('name')->nullable();
            $table->string('cover')->nullable();
            $table->string('cover_big')->nullable();
            $table->string('city')->nullable();
            $table->string('route')->nullable();
            $table->text('language')->nullable();
            $table->string('category')->nullable();
            $table->string('active_for')->nullable();
            $table->string('member_count')->nullable();
            $table->text('timing')->nullable();
            $table->string('price')->nullable();
            $table->string('currency')->nullable();
            $table->string('service')->nullable();
            $table->string('other')->nullable();
            $table->string('what_to_take')->nullable();
            $table->text('photo')->nullable();
            $table->text('about')->nullable();       
            $table->string('active')->default(0);
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
        Schema::dropIfExists('tours');
    }
}
