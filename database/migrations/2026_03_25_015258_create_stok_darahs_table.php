<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stok_darahs', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->enum('golongan', ['A', 'B', 'AB', 'O']);
            $table->integer('jumlah');
            $table->date('tanggal_update');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stok_darahs');
    }
};
