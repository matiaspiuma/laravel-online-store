<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('variants', function (Blueprint $table) {
            // identifiers
            $table->id();
            $table->uuid('uuid')->unique();

            // attributes
            $table->string('name');
            $table->unsignedInteger('cost')->default(0);
            $table->unsignedInteger('retail')->default(0);
            $table->unsignedInteger('height')->nullable();
            $table->unsignedInteger('width')->nullable();
            $table->unsignedInteger('length')->nullable();
            $table->unsignedInteger('weight')->nullable();

            // state
            $table->boolean('is_active')->default(true);
            $table->boolean('shippable')->default(false);

            // relationships
            $table->foreignId('product_id')
                ->index()
                ->constrained()
                ->cascadeOnDelete();

            // timestamps
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('variants');
    }
};
