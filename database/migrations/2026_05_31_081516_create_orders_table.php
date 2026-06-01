<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // مبالغ به تومان (integer)
            $table->unsignedBigInteger('subtotal'); // جمع آیتم‌ها
            $table->unsignedBigInteger('total');    // فعلاً برابر subtotal (بعداً ارسال/تخفیف اضافه می‌کنیم)

            $table->string('status')->default('pending'); // pending/paid/cancelled/...
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
