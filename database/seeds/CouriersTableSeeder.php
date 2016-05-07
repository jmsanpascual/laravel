<?php

use Illuminate\Database\Seeder;
use App\Courier;

class CouriersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Disable FOREIGN_KEY_CHECKS to execute truncate wihtout errors
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Courier::truncate(); // Reset the table
        DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // Enable after truncate

        $couriers = [
            [
                'name' => 'AIR21',
                'account_number' => '10111111',
            ],
            [
                'name' => 'CAPEX',
                'account_number' => '10092874',
            ],
            [
                'name' => 'VCARGO',
                'account_number' => '9876',
            ],
            [
                'name' => '2GO',
                'account_number' => '12345677',
            ],
            [
                'name' => 'AP CARGO',
                'account_number' => '8976654',
            ],
            [
                'name' => 'VECTRA',
                'account_number' => null,
            ],
        ];

        $now = DB::raw('CURRENT_TIMESTAMP');
        foreach($couriers as $key => $val) {
            $couriers[$key]['created_at'] = $now;
            $couriers[$key]['updated_at'] = $now;
        }


        Courier::insert($couriers);
    }
}
