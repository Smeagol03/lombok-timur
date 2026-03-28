<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('slider_heros', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('judul');
            $table->text('subtitle')->nullable();
            $table->string('gambar')->nullable();
            $table->string('url_link')->nullable();
            $table->string('label_tombol')->nullable();
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('slider_heros');
    }
};
