<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('scheds')) {
            Schema::create('scheds', function (Blueprint $table) {
                $table->increments('id');
                $table->string('category_name');
                $table->integer('Monday')->default('0');
                $table->integer('Tuesday')->default('0');
                $table->integer('Wednesday')->default('0');
                $table->integer('Thursday')->default('0');
                $table->integer('Friday')->default('0');
                $table->integer('Saturday')->default('0');
                $table->integer('Sunday')->default('0');
                $table->integer('working_days')->default('0');
                $table->integer('day_off')->default('0');
                $table->string('type');
                $table->integer('status')->default('0');
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
        Schema::dropIfExists('scheds');
    }
}
