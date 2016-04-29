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
        foreach($regions as $key => $val) {
            $regions[$key]['created_at'] = $now;
            $regions[$key]['updated_at'] = $now;
        }

        Region::insert($regions);
    }
}
