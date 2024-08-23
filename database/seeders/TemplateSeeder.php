<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $templates = [
            [
                'id' => Str::orderedUuid(),
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
                'id' => Str::orderedUuid(),
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
        ];

        foreach ($templates as $template) {
            DB::table('templates')->insert($template);
        }
    }
}
