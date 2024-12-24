<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('additional_info')->nullable()->after('payment_method');
            $table->decimal('delivery_fee', 8, 2)->nullable()->after('additional_info');
            $table->string('delivery_distance')->nullable()->after('delivery_fee');
            $table->decimal('price_per_mile', 8, 2)->nullable()->after('delivery_distance');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['additional_info', 'delivery_fee', 'delivery_distance', 'price_per_mile']);
        });
    }
}
