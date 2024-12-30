<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusOnlinePayAndSessionIdToOrdersTable extends Migration
{
 
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('status_online_pay', ['paid', 'unpaid'])->nullable()->after('status');
            $table->string('session_id')->nullable()->after('status_online_pay'); // Add session_id column after status_online_pay
        });
    }

 
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('status_online_pay');
            $table->dropColumn('session_id');
        });
    }
}
