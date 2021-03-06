<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CouriersTableSeeder::class);
        $this->call(RegionsTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(UserRegionAccessSeeder::class);
        $this->call(CompanyDetailsTableSeeder::class);
    }
}
