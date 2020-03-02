<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        if(!Schema::hasTable('pages')) {
            Schema::create('pages', function (Blueprint $table) {
                $table->increments('id');
                $table->string('logo')->nullable();
                $table->longText('header')->nullable();
                $table->string('background1')->nullable();
                $table->string('title1')->nullable();
                $table->string('background2')->nullable();
                $table->string('title2')->nullable();
                $table->string('background3')->nullable();
                $table->string('title3')->nullable();
                $table->longText('content1')->nullable();
                $table->longText('subject1')->nullable();
                $table->longText('content2')->nullable();
                $table->longText('subject2')->nullable();
                $table->longText('content3')->nullable();
                $table->longText('subject3')->nullable();
                $table->longText('newsfeeds')->nullable();
                $table->string('footer')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
