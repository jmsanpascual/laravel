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
                'user_id' => 2,
                'region_id' => 1,
                'permission' => 15,
            ],
        ];

        for($i = 1; $i <= 4; $i++) {
            // Assign access to all regions to root user
            $rootUser = [
                'user_id' => 1,
                'region_id' => $i,
                'permission' => 15,
            ];

            array_push($regionAccess, $rootUser);
        }

        $now = DB::raw('CURRENT_TIMESTAMP');
        foreach($regionAccess as $key => $val) {
            $regionAccess[$key]['created_at'] = $now;
            $regionAccess[$key]['updated_at'] = $now;
        }

        $table->insert($regionAccess);
    }
}
