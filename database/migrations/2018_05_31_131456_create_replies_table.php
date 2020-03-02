<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('replies')) {
        Schema::create('replies', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->unsigned();
                $table->integer('email_id')->unsigned();
                $table->integer('client_id')->unsigned();
                $table->string('message');
                $table->string('status')->default('Mark as Read');
                $table->foreign('user_id')->references('id')->on('users');  
                $table->foreign('email_id')->references('id')->on('emails');
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
        Schema::dropIfExists('replies');
    }
}
