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
        Schema::create('t_m_a_s', function (Blueprint $table) {
            $table->id()->primary();
            $table->integer('user_id')->nullable();
            $table->integer('project_id')->nullable();
            $table->date('date')->nullable();
            $table->string('work_time')->nullable();
            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_m_a_s');
    }
};
