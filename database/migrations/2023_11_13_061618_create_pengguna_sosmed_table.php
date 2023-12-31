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
        Schema::create('pengguna_sosmed', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('users_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('link');
            $table->string('sosmed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengguna_sosmed');
    }
};
