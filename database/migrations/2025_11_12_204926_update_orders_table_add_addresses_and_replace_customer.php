<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Replace customer_id with user_id
            if (Schema::hasColumn('orders', 'customer_id')) {
                $table->renameColumn('customer_id', 'user_id');
            } else {
                $table->unsignedBigInteger('user_id')->nullable()->after('order_no');
            }

            // Add address references (nullable)
            $table->unsignedBigInteger('delivery_address_id')->nullable()->after('user_id');
            $table->unsignedBigInteger('billing_address_id')->nullable()->after('delivery_address_id');

            // Add foreign keys (optional, depending on your setup)
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('delivery_address_id')->references('id')->on('addresses')->nullOnDelete();
            $table->foreign('billing_address_id')->references('id')->on('addresses')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Rollback
            $table->dropForeign(['user_id']);
            $table->dropForeign(['delivery_address_id']);
            $table->dropForeign(['billing_address_id']);

            $table->dropColumn(['delivery_address_id', 'billing_address_id']);

            // Revert user_id back to customer_id if needed
            if (Schema::hasColumn('orders', 'user_id')) {
                $table->renameColumn('user_id', 'customer_id');
            }
        });
    }
};
