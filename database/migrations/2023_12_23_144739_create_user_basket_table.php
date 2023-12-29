<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        if (!Schema::hasTable('user_basket')) {
            Schema::create('user_basket', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
                $table->foreignId('moto_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
                $table->integer('quantity');
                $table->enum('status', ['pendingTransaction', 'paymentFinished', 'removedWithoutFinish']);
                $table->dateTimeTz('start_date');
                $table->dateTimeTz('end_date');
                $table->decimal('total_price');
                $table->string('total_price_currency');
                $table->timestamps();
            });
        }
    }
    
    public function down(): void {
        Schema::dropIfExists('user_basket');
    }
    
};
