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
        Schema::create('service_worker', function (Blueprint $table) {
            $table->primary(['worker_id', 'service_id']);
            $table->foreignId('worker_id')->constrained('users');
            $table->foreignId('service_id')->constrained('services');
            $table->integer('price');
            $table->integer('minutesNeeded');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_worker');
    }
};
