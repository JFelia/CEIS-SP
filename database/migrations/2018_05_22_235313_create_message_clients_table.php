<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('message_clients')) {
            Schema::create('message_clients', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('client_id')->unsigned();
                $table->integer('contact_id')->unsigned();
                $table->integer('message_id')->unsigned();
                $table->integer('user_id')->unsigned();
                $table->integer('type')->unsigned();
                $table->string('month_year');
                $table->string('identifier')->nullable();
                $table->string('status')->default('out');
                $table->foreign('client_id')->references('id')->on('users');
                $table->foreign('contact_id')->references('id')->on('contacts');
                $table->foreign('message_id')->references('id')->on('messages');
                $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('message_clients');
    }
}
