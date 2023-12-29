<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use app\Models\RentPoint;
use app\Models\User;

return new class extends Migration {
    public function up(): void {
        if (!Schema::hasTable('rent_point_user')) {
            Schema::create('rent_point_user', function (Blueprint $table) {
                $table->id();
                $table->foreignId('rent_point_id')->constrained('rent_points')->cascadeOnUpdate()->cascadeOnDelete();
                $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
                $table->timestamps();
            });
        }
    }

    public function down(): void {
        Schema::dropIfExists('rent_point_user');
    }
};
