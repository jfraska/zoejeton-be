<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $guests = [
            [
                'id' => (string) Str::uuid(),
                'code' => 'GUEST001',
                'name' => 'John Doe',
                'address' => '123 Elm Street',
                'category' => 1,
                'status' => 1,
                'sosmed' => json_encode([
                    'facebook' => 'https://facebook.com/johndoe',
                    'instagram' => 'https://instagram.com/johndoe'
                ]),
                'attended' => json_encode([
                    'ceremony' => true,
                    'reception' => false
                ]),
                'created_at' => now(),
                'updated_at' => now(),
                'invitation_id' => 'uuid-of-invitation-1', // Replace with actual UUID from invitations table
                'group_id' => 1, // Replace with actual ID from groups table
            ],
            [
                'id' => (string) Str::uuid(),
                'code' => 'GUEST002',
                'name' => 'Jane Smith',
                'address' => '456 Oak Avenue',
                'category' => 2,
                'status' => 0,
                'sosmed' => json_encode([
                    'twitter' => 'https://twitter.com/janesmith'
                ]),
                'attended' => json_encode([
                    'ceremony' => false,
                    'reception' => false
                ]),
                'created_at' => now(),
                'updated_at' => now(),
                'invitation_id' => 'uuid-of-invitation-2', // Replace with actual UUID from invitations table
                'group_id' => 2, // Replace with actual ID from groups table
            ],
            [
                'id' => (string) Str::uuid(),
                'code' => 'GUEST003',
                'name' => 'Michael Johnson',
                'address' => '789 Pine Road',
                'category' => 3,
                'status' => 1,
                'sosmed' => json_encode([
                    'linkedin' => 'https://linkedin.com/in/michaeljohnson'
                ]),
                'attended' => json_encode([
                    'ceremony' => true,
                    'reception' => true
                ]),
                'created_at' => now(),
                'updated_at' => now(),
                'invitation_id' => 'uuid-of-invitation-3', // Replace with actual UUID from invitations table
                'group_id' => 3, // Replace with actual ID from groups table
            ],
            [
                'id' => (string) Str::uuid(),
                'code' => 'GUEST004',
                'name' => 'Emily Davis',
                'address' => '101 Maple Lane',
                'category' => 1,
                'status' => 0,
                'sosmed' => json_encode([
                    'snapchat' => 'https://snapchat.com/add/emilydavis'
                ]),
                'attended' => json_encode([
                    'ceremony' => false,
                    'reception' => true
                ]),
                'created_at' => now(),
                'updated_at' => now(),
                'invitation_id' => 'uuid-of-invitation-4', // Replace with actual UUID from invitations table
                'group_id' => 4, // Replace with actual ID from groups table
            ],
            [
                'id' => (string) Str::uuid(),
                'code' => 'GUEST005',
                'name' => 'Sarah Wilson',
                'address' => '202 Birch Street',
                'category' => 2,
                'status' => 1,
                'sosmed' => json_encode([
                    'pinterest' => 'https://pinterest.com/sarahwilson'
                ]),
                'attended' => json_encode([
                    'ceremony' => true,
                    'reception' => true
                ]),
                'created_at' => now(),
                'updated_at' => now(),
                'invitation_id' => 'uuid-of-invitation-5', // Replace with actual UUID from invitations table
                'group_id' => 5, // Replace with actual ID from groups table
            ]
        ];

        foreach ($guests as $guest) {
            DB::table('guests')->insert($guest);
        }
    }
}
