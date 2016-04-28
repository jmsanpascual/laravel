<?php

use Illuminate\Database\Seeder;
use App\AccessRight;
class AccessRightsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        AccessRight::truncate(); // rollback
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        $accessRights = [
            [
                'bit' => 1,
                'name' => 'Add'
            ],
            [
                'bit' => 2,
                'name' => 'Edit'
            ],
            [
                'bit' => 4,
                'name' => 'Delete'
            ],
            [
                'bit' => 8,
                'name' => 'View'
            ],
        ];

        $now = DB::raw('CURRENT_TIMESTAMP');
        foreach($accessRights as $key => $val) {
            $accessRights[$key]['created_at'] = $now;
            $accessRights[$key]['updated_at'] = $now;
        }

        AccessRight::insert($accessRights);
    }
}
