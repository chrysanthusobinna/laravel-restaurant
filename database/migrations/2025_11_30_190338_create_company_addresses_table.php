<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /**
         * STEP 1 — DROP FK + COLUMN (old relationship)
         */
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'pickup_address_id')) {
                // Drop old FK (if exists)
                try {
                    $table->dropForeign(['pickup_address_id']);
                } catch (\Exception $e) {}

                // Drop old column
                $table->dropColumn('pickup_address_id');
            }
        });

        /**
         * STEP 2 — DROP OLD restaurant_addresses TABLE
         */
        Schema::dropIfExists('restaurant_addresses');

        /**
         * STEP 3 — ADD pickup_address_id AGAIN (for new company_addresses table)
         */
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('pickup_address_id')
                  ->nullable()
                  ->after('delivery_address_id');
        });

        /**
         * STEP 4 — ADD NEW FK to company_addresses TABLE
         */
        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('pickup_address_id')
                  ->references('id')
                  ->on('company_addresses')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        // Reverse the operations

        // DROP FK referencing company_addresses
        Schema::table('orders', function (Blueprint $table) {
            try {
                $table->dropForeign(['pickup_address_id']);
            } catch (\Exception $e) {}
            $table->dropColumn('pickup_address_id');
        });

        // Restore restaurant_addresses
        Schema::create('restaurant_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->timestamps();
        });

        // Add back original column + FK referencing restaurant_addresses
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('pickup_address_id')->nullable();
            $table->foreign('pickup_address_id')
                  ->references('id')
                  ->on('restaurant_addresses')
                  ->onDelete('set null');
        });
    }
};
