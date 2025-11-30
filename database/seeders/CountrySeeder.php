<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'name'            => 'Ghana',
                'iso_code'        => 'GH',
                'currency_code'   => 'GHS',
                'currency_symbol' => '₵',    
            ],
            [
                'name'            => 'Nigeria',
                'iso_code'        => 'NG',
                'currency_code'   => 'NGN',
                'currency_symbol' => '₦',    
            ],
            [
                'name'            => 'United Kingdom',
                'iso_code'        => 'GB',
                'currency_code'   => 'GBP',
                'currency_symbol' => '£',    
            ],
            [
                'name'            => 'United States',
                'iso_code'        => 'US',
                'currency_code'   => 'USD',
                'currency_symbol' => '$',    
            ]
        ];

        foreach ($data as $row) {
            Country::updateOrCreate(
                ['iso_code' => $row['iso_code']],
                $row
            );
        }
    }
}
