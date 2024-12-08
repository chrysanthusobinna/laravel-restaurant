<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTwoFactorAuthToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Add the two_factor_auth column with default 0
            $table->boolean('two_factor_auth')->default(0);
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the column if the migration is rolled back
            $table->dropColumn('two_factor_auth');
        });
    }
}
