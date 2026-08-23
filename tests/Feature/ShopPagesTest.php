<?php

namespace Tests\Feature;

use App\Models\Shop;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShopPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_shows_featured_shops(): void
    {
        $featured = Shop::factory()->featured()->create(['name' => 'Featured Scoop']);
        Shop::factory()->create(['name' => 'Regular Shop', 'is_featured' => false]);

        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee('Featured Scoop');
        $response->assertDontSee('Regular Shop');
    }

    public function test_reviews_index_lists_only_visited_shops(): void
    {
        Shop::factory()->create(['name' => 'Visited Shop']);
        Shop::factory()->wantToVisit()->create(['name' => 'Wishlist Shop']);

        $response = $this->get(route('reviews.index'));

        $response->assertOk();
        $response->assertSee('Visited Shop');
        $response->assertDontSee('Wishlist Shop');
    }

    public function test_shop_show_page_displays_review_body_for_visited_shop(): void
    {
        $shop = Shop::factory()->create([
            'name' => 'Reviewed Shop',
            'body' => 'A truly excellent scoop of pistachio.',
        ]);

        $response = $this->get(route('shops.show', $shop));

        $response->assertOk();
        $response->assertSee('Reviewed Shop');
        $response->assertSee('A truly excellent scoop of pistachio.');
    }

    public function test_shop_show_page_displays_placeholder_for_unvisited_shop(): void
    {
        $shop = Shop::factory()->wantToVisit()->create(['name' => 'Someday Shop']);

        $response = $this->get(route('shops.show', $shop));

        $response->assertOk();
        $response->assertSee('Someday Shop');
        $response->assertSee("still on the list");
    }
}
