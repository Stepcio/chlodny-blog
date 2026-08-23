<?php

namespace Tests\Feature;

use App\Models\Shop;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RankingsAndWishlistTest extends TestCase
{
    use RefreshDatabase;

    public function test_rankings_page_lists_featured_shops_in_rating_order(): void
    {
        Shop::factory()->featured()->create(['name' => 'Second Place', 'rating' => 4]);
        Shop::factory()->featured()->create(['name' => 'First Place', 'rating' => 5]);
        Shop::factory()->create(['name' => 'Not Featured', 'is_featured' => false]);

        $response = $this->get(route('rankings.index'));

        $response->assertOk();
        $response->assertSeeInOrder(['First Place', 'Second Place']);
        $response->assertDontSee('Not Featured');
    }

    public function test_wishlist_page_lists_only_want_to_visit_shops(): void
    {
        Shop::factory()->wantToVisit()->create(['name' => 'Someday Shop']);
        Shop::factory()->create(['name' => 'Already Visited']);

        $response = $this->get(route('wishlist.index'));

        $response->assertOk();
        $response->assertSee('Someday Shop');
        $response->assertDontSee('Already Visited');
    }
}
