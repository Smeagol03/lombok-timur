<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('harga_poks', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('nama_komoditi');
            $table->string('satuan');
            $table->integer('harga');
            $table->date('tanggal_update');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('harga_poks');
    }
};
