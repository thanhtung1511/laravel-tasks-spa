<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->unsignedBigInteger('assigner_id');
            $table->unsignedBigInteger('assignee_id')->nullable();
            $table->unsignedBigInteger('completed_by')->nullable();
            $table->string('name');
            $table->tinyInteger('status');
            $table->timestamps();

            $table->foreign('assigner_id')->on('users')->references('id');
            $table->foreign('assignee_id')->on('users')->references('id');
            $table->foreign('completed_by')->on('users')->references('id');
        });
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
