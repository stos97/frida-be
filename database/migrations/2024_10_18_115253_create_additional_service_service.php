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
        Schema::create('additional_service_service', function (Blueprint $table) {
            $table->primary(['service_id', 'additional_service_id']);
            $table->foreignId('service_id')->constrained('services');
            $table->foreignId('additional_service_id')->constrained('additional_services');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('additional_service_service');
    }
};
