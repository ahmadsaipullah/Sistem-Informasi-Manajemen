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
        Schema::create('wip_komponens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('komponen_id')->constrained('order_requests')->onDelete('cascade');
            $table->foreignId('mesin_id')->constrained('mesins')->onDelete('cascade');
            $table->string('lokasi');
            $table->date('tanggal_out');
            $table->string('jumlah_out');
            $table->string('status')->default('Selesai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wip_komponens');
    }
};
