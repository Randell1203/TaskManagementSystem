<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->text('description')->nullable(true);
            $table->tinyInteger('status');
            $table->integer('added_by_id');
            $table->integer('updated_by_id')->nullable(true)->default(null);
            $table->timestamps();
        });

        DB::table('department')->insert($arrayData = array(
            'name' => 'Information Technology',
            'description' => '',
            'status' => 1,
            'added_by_id' => 1,
            'updated_by_id' => 1,
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
        ));

        DB::table('department')->insert($arrayData = array(
            'name' => 'Accounting',
            'description' => '',
            'status' => 1,
            'added_by_id' => 1,
            'updated_by_id' => 1,
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
        ));

        DB::table('department')->insert($arrayData = array(
            'name' => 'Marketing',
            'description' => '',
            'status' => 1,
            'added_by_id' => 1,
            'updated_by_id' => 1,
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
        ));

        DB::table('department')->insert($arrayData = array(
            'name' => 'Sales',
            'description' => '',
            'status' => 1,
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
        Schema::dropIfExists('department');
    }
}
