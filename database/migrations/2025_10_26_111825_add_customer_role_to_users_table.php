<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE `users` MODIFY `role` ENUM('admin', 'global_admin', 'customer') NOT NULL DEFAULT 'customer'");
    }

    public function down(): void
    {
        // rollback ENUM without customer
        DB::statement("ALTER TABLE `users` MODIFY `role` ENUM('admin', 'global_admin') NOT NULL DEFAULT 'admin'");
    }
};
