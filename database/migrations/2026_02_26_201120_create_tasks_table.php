<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('tasks')) {
            Schema::create('tasks', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('title');
                $table->text('description')->nullable();
                $table->enum('status', ['pending', 'in_progress', 'completed'])
                    ->default('pending')
                    ->index();
                $table->timestamp('due_at')->index();
                $table->softDeletes();
                $table->timestamps();
            });
        }

    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
