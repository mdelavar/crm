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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("mobile");
            $table->text("address")->nullable();
            $table->string("website")->nullable();;
            $table->string("phone")->nullable();;
            $table->string("email")->nullable();;
            $table->string("social")->nullable();;
            $table->string("postal_code")->nullable();;
            $table->integer('status')->default(0);

            // History Fields
            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users');
            $table->foreignId('changed_by')
                ->nullable()
                ->constrained('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
