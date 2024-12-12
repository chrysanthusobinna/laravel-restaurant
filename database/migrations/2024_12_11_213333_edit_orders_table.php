<?php
 use Illuminate\Database\Migrations\Migration;
 use Illuminate\Database\Schema\Blueprint;
 use Illuminate\Support\Facades\Schema;
 
 class EditOrdersTable extends Migration
 {
     /**
      * Run the migrations.
      *
      * @return void
      */
     public function up()
     {
         Schema::table('orders', function (Blueprint $table) {
             // Remove columns
             $table->dropColumn(['customer_name', 'customer_email', 'customer_address']);
             
             // Add new columns
             $table->unsignedBigInteger('customer_id')->nullable()->after('id');
             $table->enum('order_type', ['online', 'instore'])->after('customer_id');
             $table->unsignedBigInteger('created_by_user_id')->nullable()->after('order_type');
             $table->unsignedBigInteger('updated_by_user_id')->nullable()->after('created_by_user_id');
             
             // Add foreign keys
             $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
             $table->foreign('created_by_user_id')->references('id')->on('users')->onDelete('cascade');
             $table->foreign('updated_by_user_id')->references('id')->on('users')->onDelete('cascade');
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
             // Add removed columns back
             $table->string('customer_name');
             $table->string('customer_email');
             $table->string('customer_address');
             
             // Drop newly added columns
             $table->dropForeign(['customer_id']);
             $table->dropForeign(['created_by_user_id']);
             $table->dropForeign(['updated_by_user_id']);
             $table->dropColumn(['customer_id', 'order_type', 'created_by_user_id', 'updated_by_user_id']);
         });
     }
 }
 