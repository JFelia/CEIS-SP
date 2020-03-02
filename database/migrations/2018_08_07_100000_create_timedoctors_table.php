<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimedoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('timedoctors')) {
            Schema::create('timedoctors', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->unsigned();
                $table->string('sched_start')->nullable();
                $table->string('sched_end')->nullable();
                $table->time('am_time_in')->nullable();
                $table->time('am_time_out')->nullable();
                $table->time('pm_time_in')->nullable();
                $table->time('pm_time_out')->nullable();
                $table->date('date');
                $table->string('month_year');
                $table->string('day');
                $table->string('remarks')->nullable();
                $table->string('status')->nullable();
                $table->string('identifier')->nullable();
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
        Schema::dropIfExists('timedoctors');
    }
}
