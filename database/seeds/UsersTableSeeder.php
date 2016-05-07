<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        $users = [
            [
                'role_id' => 1,
                'name' => 'Admin',
                'username' => 'admin',
                'password' => 'admin',
            ],
            [
                'role_id' => 2,
                'name' => 'Warehouse',
                'username' => 'warehouse',
                'password' => 'warehouse',
            ],
            [
                'role_id' => 2,
                'name' => 'NLU',
                'username' => 'nlu',
                'password' => 'nlu',
            ],
            [
                'role_id' => 2,
                'name' => 'CLU',
                'username' => 'clu',
                'password' => 'clu',
            ],
            [
                'role_id' => 2,
                'name' => 'SLU',
                'username' => 'slu',
                'password' => 'slu',
            ],
            [
                'role_id' => 2,
                'name' => 'BIC',
                'username' => 'bic',
                'password' => 'bic',
            ],
            [
                'role_id' => 2,
                'name' => 'MNL',
                'username' => 'mnl',
                'password' => 'mnl',
            ],
            [
                'role_id' => 2,
                'name' => 'ILO',
                'username' => 'ilo',
                'password' => 'ilo',
            ],
            [
                'role_id' => 2,
                'name' => 'CEB',
                'username' => 'ceb',
                'password' => 'ceb',
            ],
            [
                'role_id' => 2,
                'name' => 'CDO',
                'username' => 'cdo',
                'password' => 'cdo',
            ],
            [
                'role_id' => 2,
                'name' => 'DVO',
                'username' => 'dvo',
                'password' => 'dvo',
            ],
            [
                'role_id' => 2,
                'name' => 'ZMB',
                'username' => 'zmb',
                'password' => 'zmb',
            ],
            [
                'role_id' => 2,
                'name' => 'ISL',
                'username' => 'isl',
                'password' => 'isl',
            ],
        ];

        $now = DB::raw('CURRENT_TIMESTAMP');
        foreach($users as $key => $val) {
            $users[$key]['created_at'] = $now;
            $users[$key]['updated_at'] = $now;
        }

        User::insert($users);
    }
}
