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
        Schema::create('lkp_sosmed', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lkp_id')->constrained('lkp')->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('link_sosmed');
            $table->string('sosmed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lkp_sosmed');
    }
};
