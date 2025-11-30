<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name');              // e.g. Ghana
            $table->string('iso_code', 2);       // e.g. GH
            $table->string('currency_code', 3);  // e.g. GHS
            $table->string('currency_symbol');   // e.g. ₵
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('countries');
    }

};
