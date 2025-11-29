<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            // Add the pickup address pointer
            if (!Schema::hasColumn('orders', 'pickup_address_id')) {
                $table->unsignedBigInteger('pickup_address_id')->nullable()->after('delivery_address_id');

                // Foreign key to restaurant_addresses table
                $table->foreign('pickup_address_id')
                      ->references('id')
                      ->on('restaurant_addresses')
                      ->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            if (Schema::hasColumn('orders', 'pickup_address_id')) {
                $table->dropForeign(['pickup_address_id']);
                $table->dropColumn('pickup_address_id');
            }
        });
    }
};
