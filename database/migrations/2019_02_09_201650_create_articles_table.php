<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('country');
            $table->string('city');
            $table->string('introtext');
            $table->text('content');
            $table->string('cover');
            $table->string('cover_big');
            $table->string('seo_title');
            $table->string('seo_keyword');
            $table->string('seo_description');
            
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
        Schema::dropIfExists('articles');
    }
}
