<?php

namespace Database\Seeders;

use App\Models\Shop;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Real, well-known Warsaw ice cream spots as starter content. Two are
     * marked "visited" with placeholder review text so you can see how a
     * full entry renders — replace that text with your own notes once
     * you've actually been. Edit freely, this is just a starting point.
     */
    public function run(): void
    {
        $shops = [
            [
                'name' => 'Grycan',
                'district' => 'Śródmieście',
                'description' => 'Kultowa polska marka lodów z kilkoma lodziarniami w centrum miasta.',
                'status' => 'visited',
                'is_featured' => true,
                'rating' => 5,
                'visited_at' => now()->subMonths(2),
                'body' => 'To jest tekst zastępczy, żeby zobaczyć, jak wygląda pełny wpis. Zastąp go własnymi notatkami z wizyty, zdjęciami i wrażeniami, gdy już tam będziesz!',
            ],
            [
                'name' => 'Lody Bonwit',
                'district' => 'Śródmieście',
                'description' => 'Wieloletni lokalny faworyt, znany latem z kolejek ciągnących się przez całą ulicę.',
                'status' => 'visited',
                'is_featured' => true,
                'rating' => 4.5,
                'visited_at' => now()->subMonth(),
                'body' => 'To jest tekst zastępczy, żeby zobaczyć, jak wygląda pełny wpis. Zastąp go własnymi notatkami z wizyty, zdjęciami i wrażeniami, gdy już tam będziesz!',
            ],
            [
                'name' => 'Zielona Budka',
                'district' => 'Śródmieście',
                'description' => 'Zabytkowa polska sieć lodziarni z klasycznym, bezpretensjonalnym menu.',
                'status' => 'want_to_visit',
                'is_featured' => false,
                'rating' => null,
                'visited_at' => null,
                'body' => null,
            ],
            [
                'name' => 'Cocco Bello',
                'district' => 'Śródmieście',
                'description' => 'Lody w stylu włoskim na Nowym Świecie.',
                'status' => 'want_to_visit',
                'is_featured' => false,
                'rating' => null,
                'visited_at' => null,
                'body' => null,
            ],
            [
                'name' => 'Karma Cream',
                'district' => 'Praga-Południe',
                'description' => 'Lody roślinne, warte małego objazdu.',
                'status' => 'want_to_visit',
                'is_featured' => false,
                'rating' => null,
                'visited_at' => null,
                'body' => null,
            ],
            [
                'name' => 'Toscanella',
                'district' => 'Mokotów',
                'description' => 'Osiedlowa lodziarnia z menu inspirowanym Włochami.',
                'status' => 'want_to_visit',
                'is_featured' => false,
                'rating' => null,
                'visited_at' => null,
                'body' => null,
            ],
        ];

        foreach ($shops as $shop) {
            Shop::create([
                ...$shop,
                'slug' => Str::slug($shop['name']),
            ]);
        }
    }
}
