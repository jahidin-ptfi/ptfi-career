<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();

            // Data dari CI3
            $table->string('title');
            $table->text('description');
            $table->boolean('is_active')->default(true);
            $table->string('posted_by')->nullable();
            $table->timestamp('posted_at')->nullable();

            // Data Baru
            $table->string('company')->nullable();
            $table->string('logo_initials', 5)->nullable();
            $table->string('location')->nullable();
            $table->string('type')->nullable();
            $table->string('workplace')->nullable();
            $table->string('experience')->nullable();
            $table->string('salary')->nullable();
            $table->string('category')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->json('badges')->nullable();
            $table->json('responsibilities')->nullable();
            $table->json('qualifications')->nullable();
            $table->json('benefits')->nullable();
            $table->text('company_info')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_listings');
    }
};
