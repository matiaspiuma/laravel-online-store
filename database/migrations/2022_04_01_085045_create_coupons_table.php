<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coupons', function (Blueprint $table) {
            // identifiers
            $table->id();
            $table->uuid()->unique()->index();

            // attributes
            $table->string('code')->unique()->index();
            $table->unsignedBigInteger('reduction')->default(0);
            $table->unsignedBigInteger('uses')->default(0);
            $table->unsignedBigInteger('max_uses')->nullable();
            $table->boolean('is_active')->default(true);

            // timestamps
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
