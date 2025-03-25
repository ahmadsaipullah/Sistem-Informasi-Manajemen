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

    {Schema::create('order_requests', function (Blueprint $table) {
        $table->id();
        $table->foreignId('kode_komponen_id')->constrained('komponens')->onDelete('cascade');
        $table->foreignId('operator_id')->constrained('users')->onDelete('cascade');
        $table->integer('jumlah');
        $table->string('jenis_komponen');
        $table->string('status')->default('pending');
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_requests');
    }
};
