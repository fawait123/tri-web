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
        Schema::create('brushing_teeths', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->text('note');
            $table->boolean('is_morning');
            $table->boolean('is_afternoon');
            $table->boolean('is_evening');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brushing_teeths');
    }
};
