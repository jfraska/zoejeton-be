<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InvitationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $invitations = [
            [
                'id' => "uuid-of-invitation-1",  // Generate a unique UUID
                'title' => 'Elegant Event',
                'subdomain' => 'elegant-event',
                'meta' => json_encode([
                    'description' => 'An elegant event invitation template.',
                    'keywords' => ['wedding', 'elegance', 'invitation']
                ]),
                'published' => true,
                'user_id' => 1,  // Assuming user with ID 1 exists
            ],
            [
                'id' => "uuid-of-invitation-2",
                'title' => 'Tropical Party',
                'subdomain' => 'tropical-party',
                'meta' => json_encode([
                    'description' => 'A tropical-themed party invitation template.',
                    'keywords' => ['party', 'tropical', 'invitation']
                ]),
                'published' => true,
                'user_id' => 1,  // Assuming user with ID 1 exists
            ],
            [
                'id' => "uuid-of-invitation-3",
                'title' => 'Classic Ceremony',
                'subdomain' => 'classic-ceremony',
                'meta' => json_encode([
                    'description' => 'A classic ceremony invitation template.',
                    'keywords' => ['ceremony', 'classic', 'invitation']
                ]),
                'published' => false,
                'user_id' => 1,  // Assuming user with ID 1 exists
            ]
        ];

        foreach ($invitations as $invitation) {
            DB::table('invitations')->insert($invitation);
        }
    }
}
