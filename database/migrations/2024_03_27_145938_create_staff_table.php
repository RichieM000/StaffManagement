<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->enum('gender', ['male', 'female', 'other']); // Using enum for gender
            $table->integer('age'); // Using integer for age
            $table->string('address');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('jobrole')->nullable();
           
            $table->timestamps();
        });
    
        Schema::create('work_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id')->constrained()->onDelete('cascade');
            $table->string('day_of_week');
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();
        });

        Schema::create('team_departments', function (Blueprint $table) {
            $table->id();
            $table->string('captain');
            $table->string('vice_captain');
            $table->string('secretary')->nullable();
            $table->string('chairman')->nullable();
            $table->string('kagawad')->nullable();
            $table->string('sk')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_schedules');
        Schema::dropIfExists('staff');
    }
};
