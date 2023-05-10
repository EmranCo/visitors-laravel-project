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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address')->nullable();
            $table->string('page_url')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('browser_info')->nullable();
            $table->string('country')->nullable();
            $table->string('country_code')->nullable();
            $table->string('os')->nullable();
            $table->double('data_usage')->nullable();
            $table->unsignedBigInteger('visits')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
