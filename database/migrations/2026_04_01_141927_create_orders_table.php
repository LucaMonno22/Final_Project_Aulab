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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // Chi ha fatto l'acquisto
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Dati di spedizione
            $table->string('address');
            $table->string('city');
            $table->string('courier')->default('Komerz Express');

            // Dati economici
            $table->decimal('total_price', 10, 2);
            $table->string('status')->default('paid'); // Pagato (visto che usiamo...)

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
