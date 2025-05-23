<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Untuk melacak siapa yang membuat invoice
            $table->string('invoice_number')->unique();
            $table->string('customer_name', 100);
            $table->date('delivery_date');
            $table->timestamp('submit_date')->useCurrent();
            $table->decimal('total_amount', 15, 2)->default(0); // Tambahkan ini untuk menyimpan total
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};