<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalFieldsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('status')->default(0)->after('role');
            $table->text('notice')->nullable()->after('status');
            $table->string('phone_number')->nullable()->after('notice');
            $table->text('address')->nullable()->after('phone_number');
            $table->string('profile_picture')->nullable()->after('address');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['status', 'notice', 'phone_number', 'address', 'profile_picture']);
        });
    }
}
