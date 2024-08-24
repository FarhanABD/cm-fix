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
            $table->string('email');
            $table->string('nama_perusahaan');
            $table->string('jenis_perusahaan');
            $table->text('phone');
            $table->text('alamat');
            $table->text('keterangan');
            $table->text('nama_website');
            $table->string('nama_pic');
            $table->string('phone_pic');
            $table->string('email_pic');
            $table->string('keterangan_pic');
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