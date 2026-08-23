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
                'description' => 'Iconic Polish ice cream brand with several parlours across the city centre.',
                'status' => 'visited',
                'is_featured' => true,
                'rating' => 5,
                'visited_at' => now()->subMonths(2),
                'body' => "This is placeholder text so you can see how a full entry renders. Replace it with your own visit notes, photos, and impressions once you've been!",
            ],
            [
                'name' => 'Lody Bonwit',
                'district' => 'Śródmieście',
                'description' => 'Long-running local favourite known for queues stretching down the street in summer.',
                'status' => 'visited',
                'is_featured' => true,
                'rating' => 4.5,
                'visited_at' => now()->subMonth(),
                'body' => "This is placeholder text so you can see how a full entry renders. Replace it with your own visit notes, photos, and impressions once you've been!",
            ],
            [
                'name' => 'Zielona Budka',
                'district' => 'Śródmieście',
                'description' => 'Historic Polish ice cream chain with a classic, no-frills menu.',
                'status' => 'want_to_visit',
                'is_featured' => false,
                'rating' => null,
                'visited_at' => null,
                'body' => null,
            ],
            [
                'name' => 'Cocco Bello',
                'district' => 'Śródmieście',
                'description' => 'Italian-style gelato on Nowy Świat.',
                'status' => 'want_to_visit',
                'is_featured' => false,
                'rating' => null,
                'visited_at' => null,
                'body' => null,
            ],
            [
                'name' => 'Karma Cream',
                'district' => 'Praga-Południe',
                'description' => 'Plant-based ice cream spot worth a detour.',
                'status' => 'want_to_visit',
                'is_featured' => false,
                'rating' => null,
                'visited_at' => null,
                'body' => null,
            ],
            [
                'name' => 'Toscanella',
                'district' => 'Mokotów',
                'description' => 'Neighbourhood gelateria with an Italian-leaning flavour menu.',
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
