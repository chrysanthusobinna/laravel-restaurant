<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Drop the existing users table
        Schema::dropIfExists('users');

        // Create the users table with the desired order
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['admin', 'global_admin'])->default('admin');
            $table->tinyInteger('status')->default(0);
            $table->string('phone_number')->nullable();
            $table->text('address')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('activation_token', 60)->nullable();
            $table->rememberToken();
            $table->tinyInteger('two_factor_auth')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop the users table when rolling back
        Schema::dropIfExists('users');
    }
}
