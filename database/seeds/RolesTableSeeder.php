<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Role::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        $roles = [
            [
                'name' => 'Admin'
            ],
            [
                'name' => 'User'
            ],
        ];

        $now = DB::raw('CURRENT_TIMESTAMP');
        foreach($roles as $key => $val) {
            $roles[$key]['created_at'] = $now;
            $roles[$key]['updated_at'] = $now;
        }

        Role::insert($roles);
    }
}
