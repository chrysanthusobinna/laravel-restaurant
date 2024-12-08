<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameNameToFirstNameAndAddMiddleLastNameFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Rename the 'name' column to 'first_name'
            $table->renameColumn('name', 'first_name');

            // Add the 'middle_name' and 'last_name' columns
            $table->string('middle_name')->nullable();  // Nullable middle name field
            $table->string('last_name');  // Last name field
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Revert the column name changes
            $table->renameColumn('first_name', 'name');
            
            // Drop the 'middle_name' and 'last_name' columns
            $table->dropColumn(['middle_name', 'last_name']);
        });
    }
}
