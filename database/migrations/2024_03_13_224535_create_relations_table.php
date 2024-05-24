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
        Schema::create('relations', function (Blueprint $table) {
            $table->id();
            $table->foreignId("contact_id")
                ->constrained("contacts");
            $table->foreignId("by_user")
                ->constrained("users");
            $table->foreignId("relation_category_id")
                ->constrained("relation_categories");
            $table->string("title");
            $table->dateTime("call_time");
            $table->longText("call_result");
            $table->dateTime("next_call_time")->nullable();

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
        Schema::dropIfExists('relations');
    }
};
