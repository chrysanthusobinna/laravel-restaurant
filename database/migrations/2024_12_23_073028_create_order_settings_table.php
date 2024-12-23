<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('order_settings', function (Blueprint $table) {
            $table->id();
            $table->decimal('price_per_mile', 8, 2);
            $table->integer('distance_limit_in_miles');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_settings');
    }
}
