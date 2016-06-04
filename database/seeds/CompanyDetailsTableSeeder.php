<?php

use Illuminate\Database\Seeder;

class CompanyDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('company_details')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        $company_details = [
            [
                'company_name' => 'PHILIPPINE OPPO MOBILE TECHNOLOGY, INC.',
                'phone_number' => '0917-5849968',
                'telephone_number' => '02-5101087',
                'address' => 'MANGGAHAN, PASIG',
            ],
        ];

        $now = DB::raw('CURRENT_TIMESTAMP');
        foreach($company_details as $key => $val) {
            $company_details[$key]['created_at'] = $now;
            $company_details[$key]['updated_at'] = $now;
        }

        DB::table('company_details')->insert($company_details);
    }
}
