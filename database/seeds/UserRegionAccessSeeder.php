<?php

use Illuminate\Database\Seeder;

class UserRegionAccessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = DB::table('user_region_access');

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        $table->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        $regionAccess = [
            [
                'user_id' => 3,
                'region_id' => 1,
                'permission' => 15,
            ],
            [
                'user_id' => 4,
                'region_id' => 2,
                'permission' => 15,
            ],
            [
                'user_id' => 5,
                'region_id' => 3,
                'permission' => 15,
            ],
            [
                'user_id' => 6,
                'region_id' => 4,
                'permission' => 15,
            ],
            [
                'user_id' => 7,
                'region_id' => 5,
                'permission' => 15,
            ],
            [
                'user_id' => 8,
                'region_id' => 6,
                'permission' => 15,
            ],
            [
                'user_id' => 9,
                'region_id' => 7,
                'permission' => 15,
            ],
            [
                'user_id' => 10,
                'region_id' => 8,
                'permission' => 15,
            ],
            [
                'user_id' => 11,
                'region_id' => 9,
                'permission' => 15,
            ],
            [
                'user_id' => 12,
                'region_id' => 10,
                'permission' => 15,
            ],
            [
                'user_id' => 13,
                'region_id' => 11,
                'permission' => 15,
            ],
        ];

        for($i = 1; $i <= 11; $i++) {
            // Assign access to all regions to root user
            $rootUser = [
                'user_id' => 1,
                'region_id' => $i,
                'permission' => 15,
            ];

            $warehouse = [
                'user_id' => 2,
                'region_id' => $i,
                'permission' => 8,
            ];

            array_push($regionAccess, $rootUser);
            array_push($regionAccess, $warehouse);
        }

        $now = DB::raw('CURRENT_TIMESTAMP');
        foreach($regionAccess as $key => $val) {
            $regionAccess[$key]['created_at'] = $now;
            $regionAccess[$key]['updated_at'] = $now;
        }

        $table->insert($regionAccess);
    }
}
