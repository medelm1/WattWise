<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            [
                'key' => 'currency',
                'value' => json_encode(['code' => 'USD', 'name' => 'US Dollar']),
                'description' => 'The currency used for billing',
            ],
            [
                'key' => 'energy_rate',
                'value' => '0.12',
                'description' => 'Cost of 1 kWh of electricity',
            ]
        ]);
    }
}
