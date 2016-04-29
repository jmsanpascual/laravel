<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Permission::truncate(); // rollback
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        $permissions = [
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
        foreach($permissions as $key => $val) {
            $permissions[$key]['created_at'] = $now;
            $permissions[$key]['updated_at'] = $now;
        }

        Permission::insert($permissions);
    }
}
