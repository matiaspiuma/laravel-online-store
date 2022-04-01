<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            // identifiers
            $table->id();
            $table->uuid('uuid')->index()->unique();

            // attributes
            $table->unsignedBigInteger('quantity')->default(1);

            // relationships
            $table->morphs('purchasable');
            $table->foreignId('cart_id')
                ->constrained()
                ->cascadeOnDelete();

            // timestamps
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
