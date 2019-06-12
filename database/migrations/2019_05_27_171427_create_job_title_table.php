<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobTitleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_title', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 191);
            $table->integer('department_id');
            $table->integer('added_by_id');
            $table->integer('updated_by_id')->nullable(true)->default(null);
            $table->timestamps();
        });


        DB::table('job_title')->insert($arrayData = array(
            'name' => 'Software Developer',
            'department_id' => 1,
            'added_by_id' => 1,
            'updated_by_id' => 1,
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
        ));

        DB::table('job_title')->insert($arrayData = array(
            'name' => 'System Admin',
            'department_id' => 1,
            'added_by_id' => 1,
            'updated_by_id' => 1,
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
        ));

        DB::table('job_title')->insert($arrayData = array(
            'name' => 'Network Admin',
            'department_id' => 1,
            'added_by_id' => 1,
            'updated_by_id' => 1,
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
        ));

        DB::table('job_title')->insert($arrayData = array(
            'name' => 'Junior Software Developer',
            'department_id' => 1,
            'added_by_id' => 1,
            'updated_by_id' => 1,
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
        ));

        DB::table('job_title')->insert($arrayData = array(
            'name' => 'Auditor',
            'department_id' => 2,
            'added_by_id' => 1,
            'updated_by_id' => 1,
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
        ));

        DB::table('job_title')->insert($arrayData = array(
            'name' => 'Accounting Staff',
            'department_id' => 2,
            'added_by_id' => 1,
            'updated_by_id' => 1,
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
        ));

        DB::table('job_title')->insert($arrayData = array(
            'name' => 'Accounting Manager',
            'department_id' => 2,
            'added_by_id' => 1,
            'updated_by_id' => 1,
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
        ));

        DB::table('job_title')->insert($arrayData = array(
            'name' => 'Facebook Marketing',
            'department_id' => 3,
            'added_by_id' => 1,
            'updated_by_id' => 1,
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
        ));

        DB::table('job_title')->insert($arrayData = array(
            'name' => 'Call Center Agent',
            'department_id' => 4,
            'added_by_id' => 1,
            'updated_by_id' => 1,
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
        ));

        DB::table('job_title')->insert($arrayData = array(
            'name' => 'Sales Agent',
            'department_id' => 4,
            'added_by_id' => 1,
            'updated_by_id' => 1,
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
        ));



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_title');
    }
}
