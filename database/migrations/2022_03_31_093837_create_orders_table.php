<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            // identifiers
            $table->id();
            $table->uuid('uuid')->unique()->index();

            // attributes
            $table->string('number');
            $table->string('state'); // pending, processed, completed, cancelled, refunded
            $table->string('coupon')->nullable();

            // totals
            $table->unsignedBigInteger('total')->default(0);
            $table->unsignedBigInteger('reduction')->default(0);

            // relationships
            $table->foreignId('user_id')
                ->nullable()
                ->index()
                ->constrained()
                ->nullOnDelete();
            $table->foreignId('shipping_address_id')
                ->nullable()
                ->index()
                ->constrained('addresses')
                ->nullOnDelete();
            $table->foreignId('billing_address_id')
                ->nullable()
                ->index()
                ->constrained('addresses')
                ->nullOnDelete();

            // timestamps
            $table->timestamp('processed_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamp('refunded_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
