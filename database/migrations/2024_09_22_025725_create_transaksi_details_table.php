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
        Schema::create('transaksi_details', function (Blueprint $table) {
            $table->id();
            $table->string('id_order');
            $table->string('id_perusahaan');
            $table->integer('no_perusahaan');
            $table->string('nama_perusahaan');
            $table->string('nama_pic');
            $table->text('phone_pic');
            $table->string('email_pic');
            $table->text('alamat');
            $table->string('jenis_layanan');
            $table->string('jenis_paket');
            $table->double('harga');
            $table->integer('jumlah');
            $table->double('ppn');
            $table->double('total');
            $table->double('total_amount');
            $table->date('tanggal_langganan');
            $table->date('tanggal_habis');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_details');
    }
};