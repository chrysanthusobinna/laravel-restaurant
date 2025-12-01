<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompanyAddress;

class CompanyAddressSeeder extends Seeder
{
    public function run(): void
    {
        $addresses = [
            [
                'street'       => '38 Schuster Rd',
                'city'         => 'Manchester',
                'state'        => 'England',
                'postal_code'  => 'M14 5LX',
                'country'      => 'United Kingdom',
                'latitude'     => 53.448990,   // You can update these later
                'longitude'    => -2.229520,
            ],
            [
                'street'       => '63 Bradshawgate',
                'city'         => 'Bolton',
                'state'        => 'England',
                'postal_code'  => 'BL1 1QD',
                'country'      => 'United Kingdom',
                'latitude'     => 53.577049,  // You can update these later
                'longitude'    => -2.429560,
            ]
        ];

        foreach ($addresses as $address) {
            CompanyAddress::updateOrCreate(
                [
                    'street'      => $address['street'],
                    'postal_code' => $address['postal_code'],
                ],
                $address
            );
        }
    }
}


// php artisan db:seed --class=CompanyAddressSeeder
