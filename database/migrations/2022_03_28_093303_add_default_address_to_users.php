<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('billing_address_id')
                ->nullable()
                ->after('remember_token')
                ->constrained('addresses')
                ->nullOnDelete();

            $table->foreignId('shipping_address_id')
                ->nullable()
                ->after('remember_token')
                ->constrained('addresses')
                ->nullOnDelete();
        });
    }
    
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('billing_address_id', 'shipping_address_id');
        });
    }
};
