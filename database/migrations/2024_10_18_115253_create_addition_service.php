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
        Schema::create('addition_service', function (Blueprint $table) {
            $table->primary(['service_id', 'addition_id']);
            $table->foreignId('service_id')->constrained('services')->cascadeOnDelete();
            $table->foreignId('addition_id')->constrained('additions')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addition_service');
    }
};
