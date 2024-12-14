<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['menu_id']); // Replace 'menu_id' with the actual name of your foreign key if different
            
            // Remove the 'menu_id' column
            $table->dropColumn('menu_id');

            // Add the 'menu_name' column
            $table->string('menu_name')->after('id'); // Adjust 'after' based on your column order preference
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            // Add back the 'menu_id' column
            $table->unsignedBigInteger('menu_id')->after('id');

            // Recreate the foreign key constraint
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');

            // Remove the 'menu_name' column
            $table->dropColumn('menu_name');
        });
    }
}
