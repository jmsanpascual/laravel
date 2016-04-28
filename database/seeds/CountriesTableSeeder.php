<?php

use Illuminate\Database\Seeder;
use App\Country;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Country::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        $countries = [
            [
                'name' => 'Philippines'
            ],
            [
                'name' => 'America'
            ],
            [
                'name' => 'Japan'
            ],
            [
                'name' => 'Europe'
            ],
        ];

        $now = DB::raw('CURRENT_TIMESTAMP');
        foreach($countries as $key => $val) {
            $countries[$key]['created_at'] = $now;
            $countries[$key]['updated_at'] = $now;
        }

        Country::insert($countries);
    }
}
