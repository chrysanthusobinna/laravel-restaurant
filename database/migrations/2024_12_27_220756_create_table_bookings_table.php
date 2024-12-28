<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBookingsTable extends Migration
{
 
    public function up()
    {
        Schema::create('table_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->date('date');
            $table->string('time');
            $table->integer('persons');
            $table->timestamps();
        });
    }
 
    public function down()
    {
        Schema::dropIfExists('table_bookings');
    }
}
