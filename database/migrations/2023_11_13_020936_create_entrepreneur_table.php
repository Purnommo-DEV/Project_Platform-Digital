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
        Schema::create('entrepreneur', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('users_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('lkp_id')->constrained('lkp')->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('slug');
            $table->text('deskripsi')->nullable();
            $table->string('kategori')->nullable();
            $table->foreignId('kota_id')->nullable()->constrained('kota')->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('path')->nullable();
            $table->foreignId('status_akun_id')->nullable()->constrained('status_akun')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('tanggal_berakhir')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrepreneur');
    }
};
