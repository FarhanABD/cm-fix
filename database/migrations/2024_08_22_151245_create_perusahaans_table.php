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
        Schema::create('perusahaans', function (Blueprint $table) {
            $table->id();
            $table->string('id_perusahaan');
            $table->string('email');
            $table->string('nama_perusahaan');
            $table->text('phone');
            $table->text('kota');
            $table->text('provinsi');
            $table->text('negara');
            $table->text('keterangan')->nullable();
            $table->text('nama_website');
            $table->string('nama_pic');
            $table->text('phone_pic');
            $table->string('email_pic');
            $table->text('keterangan_pic')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perusahaans');
    }
};