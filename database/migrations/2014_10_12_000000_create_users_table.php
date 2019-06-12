<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;


class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('users')){
            Schema::create('users', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('first_name');
                $table->string('middle_name')->nullable();
                $table->string('last_name');
                $table->string('username',191)->unique();
                $table->tinyInteger('user_type');
                $table->tinyInteger('department');
                $table->tinyInteger('job_title');
                $table->string('email',191)->unique();
                $table->string('mobile_no', 20)->nullable();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->tinyInteger('status');
                $table->tinyInteger('added_by_id');
                $table->tinyInteger('updated_by_id')->nullable();
                $table->rememberToken();
                $table->timestamps();
            });    

            DB::table('users')->insert($arrayData = array(
                'first_name' => 'Super',
                'last_name' => 'User',
                'username' => 'super_user123',
                'user_type' => 1,
                'job_title' => 1,
                'department' => 1,
                'email' => 'super_user123@gmail.com',
                'password' => Hash::make('admin123'),
                'status' => 1,
                'added_by_id' => 1,
                'created_at' => Carbon\Carbon::now(),
                'updated_at' => Carbon\Carbon::now(),
            ));


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
