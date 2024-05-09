<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // {id}
    // user_id
    // date
    // start_time
    // wtime 
    // end_time
    // project_id
    // {timestamp}

    public function up(): void
    {
        Schema::create('tmas', function (Blueprint $table) {
            $table->id()->primary();
            $table->foreignId('user_id')->constrained()->onDelete('restrict');
            $table->foreignId('project_id')->constrained()->onDelete('restrict');
            $table->date('date')->nullable();
            $table->string('work_time')->nullable();
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->timestamp('created_at')->default(now());
            $table->timestamp('updated_at')->default(now());
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tmas');
    }
};
