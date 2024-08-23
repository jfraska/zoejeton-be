<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = [
            [
                'name' => 'Development Team',
                'description' => 'Team responsible for software development and maintenance.',
                'type' => 'Engineering',
                'schedule' => 'Monday to Friday, 9 AM - 5 PM',
            ],
            [
                'name' => 'Marketing Team',
                'description' => 'Team focused on market research and promotion.',
                'type' => 'Marketing',
                'schedule' => 'Monday to Friday, 10 AM - 6 PM',
            ],
            [
                'name' => 'Sales Team',
                'description' => 'Team dedicated to sales and client management.',
                'type' => 'Sales',
                'schedule' => 'Monday to Friday, 8 AM - 4 PM',
            ],
            [
                'name' => 'HR Team',
                'description' => 'Team responsible for human resources and employee relations.',
                'type' => 'Human Resources',
                'schedule' => 'Monday to Friday, 9 AM - 5 PM',
            ],
        ];

        foreach ($groups as $group) {
            DB::table('groups')->insert($group);
        }
    }
}
