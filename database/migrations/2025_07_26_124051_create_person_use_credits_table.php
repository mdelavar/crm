<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('person_use_credits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_service_id')->constrained();
            $table->foreignId('service_id')->constrained();
            $table->foreignId('organization_people_id')->constrained('organization_people');
            $table->bigInteger('amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_use_credits');
    }
};
