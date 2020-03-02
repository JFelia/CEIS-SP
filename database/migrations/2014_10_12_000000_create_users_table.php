<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                //start of columns for staffs
                $table->increments('id');
                $table->string('name'); 
                $table->string('extension1')->nullable();
                $table->string('extension2')->nullable();
                $table->string('extension3')->nullable();
                $table->string('username')->unique()->nullable();
                $table->string('password')->nullable();
                $table->string('birthday')->nullable();
                $table->string('bday_year')->nullable();
                $table->string('anniversary')->nullable();
                $table->string('anniv_year')->nullable();
                $table->string('email')->unique()->nullable();
                $table->bigInteger('telephone')->nullable();
                $table->string('skype')->nullable();
                $table->string('address')->nullable();
                $table->string('state')->nullable();
                $table->string('city')->nullable();
                $table->string('zip')->nullable();
                $table->string('country')->nullable();
                $table->string('educ')->nullable();
                $table->string('user_level'); // for client also
                $table->string('sched_start')->default(0);
                $table->string('sched_end')->default(0);
                $table->string('sched_cat')->nullable();
                $table->integer('Four_D')->default(0);
                $table->string('Four_D_status')->nullable();
                $table->integer('holiday')->default(0);
                $table->string('avatar')->default('default_user.png'); // for client also
                $table->integer('status')->default(0); // for client also
                $table->string('remarks')->default('Employed');
                $table->string('resetquestion')->nullable();
                $table->string('resetanswer')->nullable();
                //end of staffs columns


                //start of client columns
                $table->string('contact_person')->nullable();
                $table->bigInteger('contact_number')->nullable();
                $table->string('email_or_call')->nullable();
                $table->string('sales')->nullable();
                $table->longText('IfNotSalesWhy')->nullable();
                $table->string('type')->nullable();
                $table->longText('updates')->nullable();
                $table->string('FollowedUpOn')->nullable();
                $table->string('service')->nullable();
                $table->longText('client_code')->nullable();
                $table->longText('rateperhour')->nullable();
                
                $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
