<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Data dari user_profil CI3
            $table->string('nama')->nullable();
            $table->string('foto')->nullable();
            $table->string('no_ktp', 20)->nullable();
            $table->string('jenis_kelamin', 15)->nullable();
            $table->string('status_pernikahan', 20)->nullable();
            $table->string('tempat_lahir', 50)->nullable();
            $table->date('tgl_lahir')->nullable();

            // Alamat Domisili
            $table->text('alamat')->nullable();
            // $table->string('kelurahan', 50)->nullable();
            // $table->string('kecamatan', 50)->nullable();
            // $table->string('kota', 50)->nullable();
            // $table->string('provinsi', 50)->nullable();

            // KODE YANG BENAR (Mengikuti struktur Laravolt)
            $table->char('provinsi_id', 2)->nullable();
            $table->char('kota_id', 4)->nullable();
            $table->char('kecamatan_id', 7)->nullable();
            $table->char('kelurahan_id', 10)->nullable();

            // Kontak & Info
            $table->string('telepon', 20)->nullable();
            $table->string('selular', 20)->nullable();
            $table->string('agama', 50)->nullable();
            $table->string('gol_darah', 5)->nullable();
            $table->integer('jml_anak')->nullable();

            // Alamat KTP
            $table->text('alamat_ktp')->nullable();
            $table->string('kelurahan_ktp', 50)->nullable();
            $table->string('kecamatan_ktp', 50)->nullable();
            $table->string('kota_ktp', 50)->nullable();
            $table->string('provinsi_ktp', 50)->nullable();

            // Sosial Media
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('tiktok')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
