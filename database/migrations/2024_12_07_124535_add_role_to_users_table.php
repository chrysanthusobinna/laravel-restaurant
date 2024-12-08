<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalFieldsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('status')->default(0)->comment('Account status: 0 = inactive, 1 = active')->after('role');
            $table->text('notice')->nullable()->comment('Admin notice for the user')->after('status');
            $table->string('phone_number')->nullable()->comment('User phone number')->after('notice');
            $table->text('address')->nullable()->comment('User address')->after('phone_number');
            $table->string('profile_picture')->nullable()->comment('Path to the user\'s profile picture')->after('address');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['status', 'notice', 'phone_number', 'address', 'profile_picture']);
        });
    }
}
