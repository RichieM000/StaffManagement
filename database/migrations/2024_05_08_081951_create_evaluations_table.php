<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('task_id');
            $table->unsignedTinyInteger('efficiency'); // Rating from 1 to 5
            $table->unsignedTinyInteger('quality'); // Rating from 1 to 5
            $table->unsignedTinyInteger('timeliness'); // Rating from 1 to 5
            $table->unsignedTinyInteger('accuracy'); // Rating from 1 to 5
            $table->unsignedTinyInteger('tardiness'); // Rating from 1 to 5
            $table->decimal('total_average', 5, 2); // Calculated from other ratings
            $table->text('feedback')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('performance_evaluations');
    }
};
