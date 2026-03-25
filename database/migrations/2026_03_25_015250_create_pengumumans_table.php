<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengumumans', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->longText('konten');
            $table->string('file_lampiran')->nullable();
            $table->boolean('is_penting')->default(false);
            $table->date('tanggal_terbit');
            $table->date('tanggal_kadaluarsa')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengumumans');
    }
};
