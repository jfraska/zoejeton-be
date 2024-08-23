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
                    [
                        'key' => 'cover',
                        'value' => [
                            'heading' => 'Zoe & Jeton',
                            'subheading' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum',
                            'background' => ['5.heic'],
                        ],
                    ],
                    [
                        'key' => 'beranda',
                        'value' => [
                            'heading' => 'Zoe & Jeton',
                            'subheading' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum',
                            'background' => ['5.heic'],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'event',
                        'value' => [
                            'akad' => [
                                'date' => 'Mei 10 2024',
                                'time' => '12.00 - 14.00',
                                'loc' => 'Grand Hotel',
                                'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie',
                            ],
                            'resepsi' => [
                                'date' => 'Mei 10 2024',
                                'time' => '12.00 - 14.00',
                                'loc' => 'Grand Hotel',
                                'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie',
                            ],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'couple',
                        'value' => [
                            'groom' => [
                                'name' => 'Jeton Hizaya',
                                'desc' => 'Putra dari Bapak Demak Parsaoran (Alm) & Ibu Ratnawati Hutauruk',
                                'image' => '5.heic',
                                'instagram' => 'https://instagram.com',
                            ],
                            'bride' => [
                                'name' => 'Zoe Himaya',
                                'desc' => 'Putri dari Bpk M Syarik & Ibu Isharni',
                                'image' => '5.heic',
                                'instagram' => 'https://instagram.com',
                            ],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'love-story',
                        'value' => [
                            'story1' => [
                                'heading' => 'Semarang, 19 Juni 2021',
                                'subheading' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum',
                            ],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'galery',
                        'value' => [
                            'image1' => '5.heic',
                            'image2' => '5.heic',
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'live-streaming',
                        'value' => [
                            'heading' => 'Zoe & Jeton',
                            'subheading' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum',
                            'date' => 'Minggu, 30 Juni 2023',
                            'time' => '12.00 - 14.00',
                            'link' => 'https://youtube.com',
                            'background' => ['4.heic'],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'thanks',
                        'value' => [
                            'heading' => 'Thank You',
                            'subheading' => 'Merupakan suatu kebahagiaan dan kehormatan bagi kami, apabila Bapak/Ibu/Saudara, berkenaan hadir dan memberikan do’a restu kepada kami.',
                            'background' => ['8.heic'],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
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
                            'background' => ['lockscreen.png'],
                        ],
                    ],
                    [
                        'key' => 'cover',
                        'value' => [
                            'heading' => 'Zoe & Jeton',
                            'subheading' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum',
                            'background' => ['lockscreen.png'],
                        ],
                    ],
                    [
                        'key' => 'beranda',
                        'value' => [
                            'heading' => 'Zoe & Jeton',
                            'date' => 'Minggu, 30 September 2026',
                            'subheading' => 'Glory be to Allah who has created humans in pairs. By asking for the Grace and Ridho of Allah SWT, we intend to invite you to our wedding reception.',
                            'references' => 'QS AR-RUM 21',
                            'background' => ['beranda.png'],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'event',
                        'value' => [
                            'akad' => [
                                'date' => 'Minggu, 30 Juni 2023',
                                'time' => '12.00 - 14.00',
                                'loc' => 'Grand Hotel',
                                'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie',
                            ],
                            'resepsi' => [
                                'date' => 'Senin, 31 Juni 2023',
                                'time' => '12.00 - 14.00',
                                'loc' => 'Grand Hotel',
                                'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie',
                            ],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'couple',
                        'value' => [
                            'groom' => [
                                'name' => 'Jeton Hizaya',
                                'desc' => 'Bapak Elkana & Ibu Shopia',
                                'image' => 'couple-1.png',
                                'instagram' => 'https://instagram.com',
                            ],
                            'bride' => [
                                'name' => 'Zoe Himaya',
                                'desc' => 'Bapak Sotama & Ibu Aishah',
                                'image' => 'couple-2.png',
                                'instagram' => 'https://instagram.com',
                            ],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'love-story',
                        'value' => [
                            'story1' => [
                                'heading' => 'SEMARANG, 19 JUNI 2021',
                                'subheading' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus.',
                            ],
                            'story2' => [
                                'heading' => 'SEMARANG, 19 JUNI 2021',
                                'subheading' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus.',
                            ],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'galery',
                        'value' => [
                            'image1' => 'gallery-1.png',
                            'image2' => 'gallery-2.png',
                            'image3' => 'gallery-3.png',
                            'image4' => 'gallery-4.png',
                            'image5' => 'gallery-5.png',
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'live-streaming',
                        'value' => [
                            'heading' => 'Zoe & Jeton',
                            'subheading' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum',
                            'date' => 'Minggu, 30 Juni 2023',
                            'time' => '12.00 - 14.00',
                            'link' => 'https://youtube.com',
                            'background' => [],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'thanks',
                        'value' => [
                            'heading' => 'Thank You',
                            'subheading' => 'Merupakan suatu kebahagiaan dan kehormataan bagi kami, apabila Bapak/Ibu/Saudara, berkenaan hadir dan memberikan do’a restu kepada kami.',
                            'background' => [],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
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
            [
                'id' => Str::orderedUuid(),
                'title' => 'Vintage',
                'slug' => 'vintage',
                'thumbnail' => 'thumbnail.jpg',
                'price' => 130000,
                'category' => 'Premium',
                'content' => json_encode([
                    [
                        'key' => 'cover',
                        'value' => [
                            'heading' => 'Zoe & Jeton',
                            'subheading' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum',
                            'background' => ['5.heic'],
                        ],
                    ],
                    [
                        'key' => 'beranda',
                        'value' => [
                            'heading' => 'Zoe & Jeton',
                            'subheading' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum',
                            'background' => ['5.heic'],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'event',
                        'value' => [
                            'akad' => [
                                'date' => 'Maret 10 2024',
                            ],
                            'resepsi' => [
                                'date' => 'Maret 10 2024',
                            ],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'couple',
                        'value' => [
                            'groom' => [
                                'name' => 'Jeton',
                                'image' => '5.heic',
                                'instagram' => 'https://instagram.com',
                            ],
                            'bride' => [
                                'name' => 'Zoe',
                                'image' => '5.heic',
                                'instagram' => 'https://instagram.com',
                            ],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'love story',
                        'value' => [
                            'heading' => 'Zoe & Jeton',
                            'subheading' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum',
                            'background' => ['5.heic'],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'galery',
                        'value' => [
                            'heading' => 'Our Galery',
                            'image1' => '5.heic',
                            'image2' => '5.heic',
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'live streaming',
                        'value' => [
                            'heading' => 'Zoe & Jeton',
                            'subheading' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum',
                            'link' => 'https://youtube.com',
                            'background' => ['5.heic'],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'thanks',
                        'value' => [
                            'heading' => 'Zoe & Jeton',
                            'subheading' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum',
                            'background' => ['5.heic'],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                ]),
                'color' => json_encode([
                    [
                        'key' => 'natural',
                        'value' => [
                            'primary' => '#263234',
                            'primary-text' => '#000',
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
                'title' => 'Modern Chic',
                'slug' => 'modern-chic',
                'thumbnail' => 'thumbnail.jpg',
                'price' => 140000,
                'discount' => 10000,
                'category' => 'Premium',
                'content' => json_encode([
                    [
                        'key' => 'cover',
                        'value' => [
                            'heading' => 'Zoe & Jeton',
                            'subheading' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum',
                            'background' => ['5.heic'],
                        ],
                    ],
                    [
                        'key' => 'beranda',
                        'value' => [
                            'heading' => 'Zoe & Jeton',
                            'subheading' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum',
                            'background' => ['5.heic'],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'event',
                        'value' => [
                            'akad' => [
                                'date' => 'Maret 10 2024',
                            ],
                            'resepsi' => [
                                'date' => 'Maret 10 2024',
                            ],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'couple',
                        'value' => [
                            'groom' => [
                                'name' => 'Jeton',
                                'image' => '5.heic',
                                'instagram' => 'https://instagram.com',
                            ],
                            'bride' => [
                                'name' => 'Zoe',
                                'image' => '5.heic',
                                'instagram' => 'https://instagram.com',
                            ],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'love story',
                        'value' => [
                            'heading' => 'Zoe & Jeton',
                            'subheading' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum',
                            'background' => ['5.heic'],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'galery',
                        'value' => [
                            'heading' => 'Our Galery',
                            'image1' => '5.heic',
                            'image2' => '5.heic',
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'live streaming',
                        'value' => [
                            'heading' => 'Zoe & Jeton',
                            'subheading' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum',
                            'link' => 'https://youtube.com',
                            'background' => ['5.heic'],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'thanks',
                        'value' => [
                            'heading' => 'Zoe & Jeton',
                            'subheading' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum',
                            'background' => ['5.heic'],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                ]),
                'color' => json_encode([
                    [
                        'key' => 'natural',
                        'value' => [
                            'primary' => '#263234',
                            'primary-text' => '#000',
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
                'title' => 'Rustic',
                'slug' => 'rustic',
                'thumbnail' => 'thumbnail.jpg',
                'price' => 110000,
                'discount' => 5000,
                'category' => 'Basic',
                'content' => json_encode([
                    [
                        'key' => 'cover',
                        'value' => [
                            'heading' => 'Zoe & Jeton',
                            'subheading' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum',
                            'background' => ['5.heic'],
                        ],
                    ],
                    [
                        'key' => 'beranda',
                        'value' => [
                            'heading' => 'Zoe & Jeton',
                            'subheading' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum',
                            'background' => ['5.heic'],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'event',
                        'value' => [
                            'akad' => [
                                'date' => 'Maret 10 2024',
                            ],
                            'resepsi' => [
                                'date' => 'Maret 10 2024',
                            ],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'couple',
                        'value' => [
                            'groom' => [
                                'name' => 'Jeton',
                                'image' => '5.heic',
                                'instagram' => 'https://instagram.com',
                            ],
                            'bride' => [
                                'name' => 'Zoe',
                                'image' => '5.heic',
                                'instagram' => 'https://instagram.com',
                            ],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'love story',
                        'value' => [
                            'heading' => 'Zoe & Jeton',
                            'subheading' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum',
                            'background' => ['5.heic'],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'galery',
                        'value' => [
                            'heading' => 'Our Galery',
                            'image1' => '5.heic',
                            'image2' => '5.heic',
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'live streaming',
                        'value' => [
                            'heading' => 'Zoe & Jeton',
                            'subheading' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum',
                            'link' => 'https://youtube.com',
                            'background' => ['5.heic'],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'thanks',
                        'value' => [
                            'heading' => 'Zoe & Jeton',
                            'subheading' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum',
                            'background' => ['5.heic'],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                ]),
                'color' => json_encode([
                    [
                        'key' => 'natural',
                        'value' => [
                            'primary' => '#263234',
                            'primary-text' => '#000',
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
                'title' => 'Elegance',
                'slug' => 'elegance',
                'thumbnail' => 'thumbnail.jpg',
                'price' => 160000,
                'category' => 'Premium',
                'content' => json_encode([
                    [
                        'key' => 'lockscreen',
                        'value' => [
                            'heading' => 'Zoe & Jeton',
                            'subheading' => 'We invite you to our wedding ceremony',
                            'background' => ['lockscreen.png'],
                        ],
                    ],
                    [
                        'key' => 'cover',
                        'value' => [
                            'heading' => 'Zoel & Cali',
                            'subheading' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum',
                            'background' => ['lockscreen.png'],
                        ],
                    ],
                    [
                        'key' => 'beranda',
                        'value' => [
                            'heading' => 'Zoe & Jeton',
                            'date' => 'Minggu, 30 September 2026',
                            'subheading' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum',
                            'background' => ['beranda.png'],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'event',
                        'value' => [
                            'akad' => [
                                'date' => 'Minggu, 30 Juni 2023',
                                'time' => '12.00 - 14.00',
                                'loc' => 'https://www.google.com/maps',
                                'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.  Etiam eu turpis molestie',
                            ],
                            'resepsi' => [
                                'date' => 'Minggu, 30 Juni 2023',
                                'time' => '12.00 - 14.00',
                                'loc' => 'https://www.google.com/maps',
                                'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.  Etiam eu turpis molestie',
                            ],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'couple',
                        'value' => [
                            'groom' => [
                                'name' => 'Jeton Hizaya',
                                'desc' => 'Putra dari Bapak Demak Parsaoran (Alm) & Ibu Ratnawati Hutauruk',
                                'image' => 'couple-1.png',
                                'instagram' => 'https://instagram.com',
                            ],
                            'bride' => [
                                'name' => 'Zoe Himaya',
                                'desc' => 'Putri dari Bpk M Syarik & Ibu Isharni',
                                'image' => 'couple-2.png',
                                'instagram' => 'https://instagram.com',
                            ],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'love-story',
                        'value' => [
                            'story1' => [
                                'heading' => 'Semarang, 19 Juni 2021',
                                'subheading' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum',
                            ],
                            'more' => 'https://instagram.com',
                            'image' => 'love-story.png',
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'galery',
                        'value' => [
                            'image1' => 'gallery-1.png',
                            'image2' => 'gallery-2.png',
                            'image3' => 'gallery-3.png',
                            'image4' => 'gallery-4.png',
                            'image5' => 'gallery-5.png',
                            'more' => 'https://google.com',
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'live-streaming',
                        'value' => [
                            'heading' => 'Zoe & Jeton',
                            'subheading' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum',
                            'date' => 'Minggu, 30 Juni 2023',
                            'time' => '12.00 - 14.00',
                            'link' => 'https://youtube.com',
                            'image' => 'streaming.png',
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'gift',
                        'value' => [
                            'heading' => 'WEDDING GIFT',
                            'subheading' => 'For those of you who want to give a token of love to the bride and groom, you can use the virtual account / E-wallet below:',
                            'link' => 'https://www.bni.co.id/id-id/',
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'thanks',
                        'value' => [
                            'heading' => 'Thank You',
                            'subheading' => 'Merupakan suatu kebahagiaan dan kehormataan bagi kami, apabila Bapak/Ibu/Saudara, berkenaan hadir dan memberikan do’a restu kepada kami.',
                            'background' => ['thanks.png'],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
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
            [
                'id' => Str::orderedUuid(),
                'title' => 'Tropical',
                'slug' => 'tropical',
                'thumbnail' => 'thumbnail.jpg',
                'price' => 125000,
                'discount' => 15000,
                'category' => 'Basic',
                'content' => json_encode([
                    [
                        'key' => 'cover',
                        'value' => [
                            'heading' => 'Zoe & Jeton',
                            'subheading' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum',
                            'background' => ['5.heic'],
                        ],
                    ],
                    [
                        'key' => 'beranda',
                        'value' => [
                            'heading' => 'Zoe & Jeton',
                            'subheading' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum',
                            'background' => ['5.heic'],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'event',
                        'value' => [
                            'akad' => [
                                'date' => 'Maret 10 2024',
                            ],
                            'resepsi' => [
                                'date' => 'Maret 10 2024',
                            ],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'couple',
                        'value' => [
                            'groom' => [
                                'name' => 'jeton',
                                'image' => '5.heic',
                                'instagram' => 'https://instagram.com',
                            ],
                            'bride' => [
                                'name' => 'zoe',
                                'image' => '5.heic',
                                'instagram' => 'https://instagram.com',
                            ],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'love story',
                        'value' => [
                            'heading' => 'Zoe & Jeton',
                            'subheading' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum',
                            'background' => ['5.heic'],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'galery',
                        'value' => [
                            'heading' => 'Our Galery',
                            'image1' => '5.heic',
                            'image2' => '5.heic',
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'live streaming',
                        'value' => [
                            'heading' => 'Zoe & Jeton',
                            'subheading' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum',
                            'link' => 'https://youtube.com',
                            'background' => ['5.heic'],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'thanks',
                        'value' => [
                            'heading' => 'Zoe & Jeton',
                            'subheading' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum',
                            'background' => ['5.heic'],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                ]),
                'color' => json_encode([
                    [
                        'key' => 'natural',
                        'value' => [
                            'primary' => '#263234',
                            'primary-text' => '#000',
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
                'title' => 'Classic',
                'slug' => 'classic',
                'thumbnail' => 'thumbnail.jpg',
                'price' => 135000,
                'category' => 'Premium',
                'content' => json_encode([
                    [
                        'key' => 'lockscreen',
                        'value' => [
                            'heading' => 'SPECIAL INVITATION',
                            'subheading' => 'Kepada Yth.',
                            'name' => 'Zoel & Cali',
                            'date' => 'Minggu, 30 September 2026',
                            'background' => ['lockscreen.png'],
                        ],
                    ],
                    [
                        'key' => 'cover',
                        'value' => [
                            'heading' => 'Zoe & Jeton',
                            'subheading' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum',
                            'background' => ['lockscreen.png'],
                        ],
                    ],
                    [
                        'key' => 'beranda',
                        'value' => [
                            'heading' => 'Zoel & Cali',
                            'subheading' => 'Glory be to Allah who has created humans in pairs. By asking for the Grace and Ridho of Allah SWT, we intend to invite you to our wedding reception.',
                            'image' => 'beranda.png',
                            'background' => [],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'event',
                        'value' => [
                            'akad' => [
                                'date' => 'Minggu, 30 Juni 2023',
                                'time' => '12.00 - 14.00',
                                'loc' => 'https://maps.google.com/maps',
                                'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.  Etiam eu turpis molestie',
                            ],
                            'resepsi' => [
                                'date' => 'Minggu, 30 Juni 2023',
                                'time' => '12.00 - 14.00',
                                'loc' => 'https://maps.google.com/maps',
                                'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.  Etiam eu turpis molestie',
                            ],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'couple',
                        'value' => [
                            'groom' => [
                                'name' => 'Zoel Ale',
                                'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus.',
                                'image' => '5.heic',
                                'instagram' => 'https://instagram.com',
                            ],
                            'bride' => [
                                'name' => 'Cali Vila',
                                'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus.',
                                'image' => '5.heic',
                                'instagram' => 'https://instagram.com',
                            ],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'love-story',
                        'value' => [
                            'story1' => [
                                'heading' => 'Semarang, 19 Juni 2021',
                                'subheading' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus.',
                                'more' => 'https://youtube.com',
                                'image' => 'beranda.png',
                            ],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'galery',
                        'value' => [
                            'image1' => 'gallery-1.png',
                            'image2' => 'gallery-2.png',
                            'image3' => 'gallery-3.png',
                            'image4' => 'gallery-4.png',
                            'image5' => 'gallery-5.png',
                            'more' => 'https://google.com',
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'live-streaming',
                        'value' => [
                            'heading' => 'Zoe & Jeton',
                            'subheading' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum',
                            'date' => 'Minggu, 30 Juni 2023',
                            'time' => '12.00 - 14.00',
                            'link' => 'https://youtube.com',
                            'background' => [],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'gift',
                        'value' => [
                            'heading' => 'WEDDING GIFT',
                            'subheading' => 'For those of you who want to give a token of love to the bride and groom, you can use the virtual account / E-wallet below:',
                            'link' => 'https://www.bni.co.id/id-id/',
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
                        ],
                    ],
                    [
                        'key' => 'thanks',
                        'value' => [
                            'heading' => 'Thank You',
                            'subheading' => 'Merupakan suatu kebahagiaan dan kehormataan bagi kami, apabila Bapak/Ibu/Saudara, berkenaan hadir dan memberikan do’a restu kepada kami.',
                            'background' => ['thanks.png'],
                        ],
                        'visible' => [
                            'disable' => false,
                            'group' => [],
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
