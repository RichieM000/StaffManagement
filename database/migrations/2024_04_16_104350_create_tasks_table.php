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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');         
            $table->string('title');
            $table->string('jobrole');
            $table->text('description');
            $table->date('deadline');
            $table->unsignedBigInteger('assigned_to'); // Foreign key to users table
            $table->enum('status', ['pending', 'in_progress', 'completed','rejected'])->default('pending');
            $table->string('rejected_reason')->nullable();
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /** 
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
