<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Drop the old order_type column if it exists
            if (Schema::hasColumn('orders', 'order_type')) {
                $table->dropColumn('order_type');
            }

            // Add the new order_type enum
            $table->enum('order_type', ['pickup', 'delivery', 'instore'])
                  ->default('delivery')
                  ->after('user_id');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Remove the new column
            if (Schema::hasColumn('orders', 'order_type')) {
                $table->dropColumn('order_type');
            }

            // Restore the original order_type column
            $table->enum('order_type', ['online', 'instore'])
                  ->default('online')
                  ->after('user_id');
        });
    }
};
