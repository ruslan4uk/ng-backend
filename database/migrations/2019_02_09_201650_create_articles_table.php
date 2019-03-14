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
            $table->string('title')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('introtext')->nullable();
            $table->text('content')->nullable();
            $table->string('cover')->nullable();
            $table->string('cover_big')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('seo_keyword')->nullable();
            $table->string('seo_description')->nullable();
            
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
