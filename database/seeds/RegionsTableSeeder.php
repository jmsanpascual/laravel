<?php

use Illuminate\Database\Seeder;
use App\Region;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Region::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        $regions = [
            [
                'name' => 'North Luzon',
                'region_code' => 'NLU',
            ],
            [
                'name' => 'Central Luzon',
                'region_code' => 'CLU',
            ],
            [
                'name' => 'South Luzon',
                'region_code' => 'SLU',
            ],
            [
                'name' => 'Bicol',
                'region_code' => 'BIC',
            ],
            [
                'name' => 'Manila',
                'region_code' => 'MNL',
            ],
            [
                'name' => 'Iloilo',
                'region_code' => 'ILO',
            ],
            [
                'name' => 'Cebu',
                'region_code' => 'CEB',
            ],
            [
                'name' => 'Cagayan De Oro',
                'region_code' => 'CDO',
            ],
            [
                'name' => 'Davao',
                'region_code' => 'DVO',
            ],
            [
                'name' => 'Zamboanga',
                'region_code' => 'ZMB',
            ],
            [
                'name' => 'Island',
                'region_code' => 'ISL',
            ],
        ];

        $now = DB::raw('CURRENT_TIMESTAMP');
        foreach($regions as $key => $val) {
            $regions[$key]['created_at'] = $now;
            $regions[$key]['updated_at'] = $now;
        }

        Region::insert($regions);
    }
}
