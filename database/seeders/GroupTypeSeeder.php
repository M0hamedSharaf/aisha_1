<?php

namespace Database\Seeders;

use App\Models\GroupType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GroupType::updateOrCreate([
            'name' => 'normal',
        ], [
            'price' => 80,
            'days_num' => 2
        ]);

        GroupType::updateOrCreate([
            'name' => 'dense',
        ], [
            'price' => 120,
            'days_num' => 4
        ]);

        GroupType::updateOrCreate([
            'name' => 'all week',
        ], [
            'price' => 200,
            'days_num' => 6
        ]);
    }
}
