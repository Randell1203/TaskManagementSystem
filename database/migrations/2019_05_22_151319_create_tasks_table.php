<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('task_title', 100);
            $table->binary('description');
            $table->integer('department_id');
            $table->integer('assigned_to');
            $table->tinyInteger('status');
            $table->dateTime('start_date')->nullable(true)->default(null);
            $table->dateTime('deadline')->nullable(true)->default(null);
            $table->integer('added_by_id');
            $table->integer('updated_by_id')->nullable(true)->default(null);
            $table->timestamps();
        });
        DB::statement("ALTER TABLE tasks MODIFY COLUMN description MEDIUMBLOB");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
