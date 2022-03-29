<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            // identifiers
            $table->id();
            $table->uuid('uuid')->unique()->index();

            // information
            $table->string('name');
            $table->mediumText('description')->nullable();
            $table->unsignedInteger('cost')->default(0);
            $table->unsignedInteger('retail')->default(0);

            // boolean flags
            $table->boolean('is_active')->default(true);
            /**
             * @todo Move default to a config/env variable
             */
            $table->boolean('vat')->default(false);

            // relationships
            $table->foreignId('category_id')
                ->nullable()
                ->index()
                ->constrained()
                ->nullOnDelete();
            $table->foreignId('range_id')
                ->nullable()
                ->index()
                ->constrained()
                ->nullOnDelete();

            // timestamps
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
