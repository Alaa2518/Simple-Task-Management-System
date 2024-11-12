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
        Schema::create('assign_user_tasks', function (Blueprint $table) {
            $table->foreignId('user_id')
                    ->constrained('users')
                    ->onDelete('cascade');
            $table->foreignId('task_id')
                    ->constrained('tasks')
                    ->onDelete('cascade');
            $table->primary(['user_id', 'task_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assign_user_tasks');
    }
};
