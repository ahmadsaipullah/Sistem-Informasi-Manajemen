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
        Schema::create('hasil_produksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produksi_id')->constrained('wip_komponens')->onDelete('cascade');
            $table->string('jam');
            $table->string('shift');
            $table->string('hasil');
            $table->string('target');
            $table->string('hambatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_produksis');
    }
};
