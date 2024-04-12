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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('lname');
            $table->enum('gender', ['male', 'female', 'other']); // Using enum for gender
            $table->integer('age'); // Using integer for age
            $table->string('address');
            $table->string('jobrole')->default('None')->change();
            $table->string('kagawad_committee_on')->default('None')->change();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('usertype')->default('user');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        
        Schema::create('work_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('day_of_week');
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();
        });
        
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
        
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
        
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->timestamp('deadline');
            $table->string('jobrole')->default('None');
            $table->boolean('completed')->default(false);
            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    
        Schema::create('staff_task', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('task_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('work_schedules', function (Blueprint $table) {
            // Drop the foreign key constraint before dropping the table
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });
        Schema::table('staff_task', function (Blueprint $table) {
            // Drop the foreign key constraints if needed
            $table->dropForeign(['user_id']);
            $table->dropForeign(['task_id']);
        });
        Schema::dropIfExists('staff_task');
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('users');
        Schema::dropIfExists('work_schedules');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('work-schedules');
    }
};
