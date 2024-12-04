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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('id_invoice');
            $table->string('id_order');
            $table->string('nama_perusahaan');
            $table->string('jenis_layanan');
            $table->string('jenis_paket');
            $table->date('tanggal_langganan');
            $table->date('tanggal_habis');
            $table->string('alamat');
            $table->string('kota');
            $table->string('provinsi');
            $table->string('country');
            $table->string('phone_pic');
            $table->string('nama_pic');
            $table->string('email_pic');
            $table->string('item_desc');
            $table->string('qty');
            $table->string('price');
            $table->double('total');
            $table->double('total_amount');
            $table->double('ppn');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};