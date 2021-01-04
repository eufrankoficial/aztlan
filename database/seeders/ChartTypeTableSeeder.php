<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ChartType;
class ChartTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
                'type' => 'Linha'
            ],
            [
                'type' => 'Pizza'
            ]
        ];

        foreach($types as $type) {
            ChartType::create($type);
        }
    }
}
