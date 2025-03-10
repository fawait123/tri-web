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
        Schema::create('observables', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->integer('s');
            $table->integer('ss');
            $table->integer('ts');
            $table->integer('sts');
            $table->json('answer');
            $table->enum('type', ['pre-test', 'post-test']);
            $table->integer('number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('observables');
    }
};
