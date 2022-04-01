<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_lines', function (Blueprint $table) {
            // identifiers
            $table->id();
            $table->uuid()->unique()->index();

            // attributes
            $table->string('title');
            $table->mediumText('description');
            $table->unsignedBigInteger('cost');
            $table->unsignedBigInteger('retail');
            $table->unsignedBigInteger('quantity');

            // relationships
            $table->morphs('purchasable');
            $table->foreignId('order_id')
                ->constrained()
                ->cascadeOnDelete();

            // timestamps
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
