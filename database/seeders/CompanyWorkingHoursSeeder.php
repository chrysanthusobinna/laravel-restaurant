<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompanyWorkingHour;

class CompanyWorkingHoursSeeder extends Seeder
{
    public function run()
    {
        $days = [
            ['day' => 'Monday',    'open' => '09:00', 'close' => '17:00', 'closed' => false],
            ['day' => 'Tuesday',   'open' => '09:00', 'close' => '17:00', 'closed' => false],
            ['day' => 'Wednesday', 'open' => '09:00', 'close' => '17:00', 'closed' => false],
            ['day' => 'Thursday',  'open' => '09:00', 'close' => '17:00', 'closed' => false],
            ['day' => 'Friday',    'open' => '09:00', 'close' => '17:00', 'closed' => false],
            ['day' => 'Saturday',  'open' => null,    'close' => null,    'closed' => true],
            ['day' => 'Sunday',    'open' => null,    'close' => null,    'closed' => true],
        ];

        foreach ($days as $item) {
            CompanyWorkingHour::create([
                'day_of_week' => $item['day'],
                'opens_at'    => $item['closed'] ? null : $item['open'],
                'closes_at'   => $item['closed'] ? null : $item['close'],
                'is_closed'   => $item['closed'],
            ]);
        }
    }
}


//  php artisan db:seed --class=CompanyWorkingHoursSeeder
