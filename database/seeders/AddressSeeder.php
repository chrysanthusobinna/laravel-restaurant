<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Address;
use Carbon\Carbon;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Address::create([
            'user_id'     => 3,
            'label'       => 'delivery',
            'street'      => '123 Banana Island Road',
            'city'        => 'Ikoyi',
            'state'       => 'Lagos',
            'postal_code' => '100001',
            'country'     => 'Nigeria',
            'is_default'  => true,
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ]);

        Address::create([
            'user_id'     => 3,
            'label'       => 'delivery',
            'street'      => '45 Admiralty Way, Lekki Phase 1',
            'city'        => 'Lekki',
            'state'       => 'Lagos',
            'postal_code' => '100242',
            'country'     => 'Nigeria',
            'is_default'  => false,
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ]);
    }
}


//php artisan db:seed --class=AddressSeeder
