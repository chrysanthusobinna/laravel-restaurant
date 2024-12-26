<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSiteSettingsTable extends Migration
{
 
    public function up()
    {
        Schema::table('site_settings', function (Blueprint $table) {
            // Drop existing columns
            $table->dropColumn(['key', 'value', 'created_at','updated_at']);

            // Add new columns
            $table->string('country')->nullable();  
            $table->string('currency_symbol', 10)->nullable();  
            $table->string('currency_code', 10)->nullable();  
            $table->timestamps();  
        });
    }

 
    public function down()
    {
        Schema::table('site_settings', function (Blueprint $table) {
            // Add the columns back
            $table->string('key');
            $table->text('value');
            $table->timestamps();  

            // Drop new columns
            $table->dropColumn(['country', 'currency_symbol', 'currency_code']);
        });
    }
}
