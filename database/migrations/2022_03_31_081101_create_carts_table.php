<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            // identifiers
            $table->id();
            $table->uuid('uuid')->index()->unique();

            // attributes
            $table->unsignedBigInteger('total')->nullable();
            $table->unsignedBigInteger('reduction')->nullable();
            $table->string('coupon')->nullable();

            // state
            /** ENUM */
            $table->string('status'); // pending, checkout-out, completed, abandoned
            /** end ENUM */
            
            // relationships
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            // timestamps
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
