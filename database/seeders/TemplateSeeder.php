<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $templates = [
            [
                'title' => 'Minimalis',
                'slug' => 'minimalis',
                'thumbnail' => 'thumbnail.jpg',
                'price' => 150000,
                'category' => 'Premium',
                'content' => json_encode([
                    [
                        'key' => 'lockscreen',
                        'value' => [
                            'heading' => 'Zoe & Jeton',
                            'subheading' => 'We invite you to our wedding ceremony',
                            'background' => ['7.heic'],
                        ],
                    ],
                    // Tambahkan konten lainnya di sini
                ]),
                'color' => json_encode([
                    [
                        'key' => 'natural',
                        'value' => [
                            'primary' => '#263234',
                            'primary-text' => '#fff',
                            'secondary' => '#9D9E9A',
                            'secondary-text' => '#fff',
                            'accent' => '#ff4081',
                            'accent-text' => '#fff',
                        ],
                    ],
                ]),
                'music' => 'music.mp3',
            ],
            [
                'title' => 'Nostalgia',
                'slug' => 'nostalgia',
                'thumbnail' => 'thumbnail.jpg',
                'price' => 120000,
                'category' => 'Basic',
                'content' => json_encode([
                    [
                        'key' => 'lockscreen',
                        'value' => [
                            'heading' => 'Zoe & Jeton',
                            'subheading' => 'We invite you to our wedding ceremony',
                            'background' => ['7.heic'],
                        ],
                    ],
                    // Tambahkan konten lainnya di sini
                ]),
                'color' => json_encode([
                    [
                        'key' => 'natural',
                        'value' => [
                            'primary' => '#263234',
                            'primary-text' => '#fff',
                            'secondary' => '#9D9E9A',
                            'secondary-text' => '#fff',
                            'accent' => '#ff4081',
                            'accent-text' => '#fff',
                        ],
                    ],
                ]),
                'music' => 'music.mp3',
            ],
            // Tambahkan template lainnya di sini
        ];

        foreach ($templates as $template) {
            DB::table('templates')->insert($template);
        }
    }
}
