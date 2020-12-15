<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('company')->delete();
        $company = file_get_contents(base_path('seeds/company.json'));
        $company = json_decode($company);

        foreach($company->companies as $com) {
            DB::table('company')->insert((array) $com);
        }

    }
}
