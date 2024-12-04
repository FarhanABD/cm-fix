<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('id_order');
            $table->double('total');
            $table->double('total_amount');
            $table->double('ppn');
            $table->boolean('status')->default(false); // Menambahkan default value
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
        Schema::dropIfExists('orders');
    }
};