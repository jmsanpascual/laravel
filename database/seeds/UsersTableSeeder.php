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
                'password' => 'admin'
            ],
            [
                'role_id' => 2,
                'name' => 'User',
                'username' => 'user',
                'password' => 'user'
            ],
        ];

        $now = DB::raw('CURRENT_TIMESTAMP');
        foreach($users as $key => $val) {
            $users[$key]['created_at'] = $now;
            $users[$key]['updated_at'] = $now;
        }

        // for ($i = 0; $i < 500; $i++) {
        //     $temp = [
        //         'role_id' => 2,
        //         'name' => 'test',
        //         'username' => 'test' . $i,
        //         'password' => 'test',
        //         'created_at' => $now,
        //         'updated_at' => $now,
        //     ];
        //
        //     array_push($users, $temp);
        // }

        User::insert($users);
    }
}
