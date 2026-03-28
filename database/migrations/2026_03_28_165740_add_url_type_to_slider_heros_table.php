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
        Schema::table('slider_heros', function (Blueprint $table) {
            $table->string('url_type')->default('internal')->after('url_link');
            $table->string('url_link_external')->nullable()->after('url_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('slider_heros', function (Blueprint $table) {
            $table->dropColumn(['url_type', 'url_link_external']);
        });
    }
};
