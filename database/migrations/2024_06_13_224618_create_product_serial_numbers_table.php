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
        Schema::create('product_serial_numbers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_serial');
            $table->string('representation_serial');
            $table->foreignId("product_id")->constrained('products');
            $table->date("ma_date");
            $table->date("ex_date");
            $table->text("description")->nullable();

            $table->foreignId('box_id')
                ->nullable()
                ->constrained('boxes');

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
        Schema::dropIfExists('product_serial_numbers');
    }
};
