<?php

namespace Tests\Feature\Admin;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ShopCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_a_shop_with_a_cover_photo(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('admin.shops.store'), [
            'name' => 'Nowa Lodziarnia',
            'description' => 'A brand new spot.',
            'status' => 'visited',
            'rating' => 5,
            'is_featured' => '1',
            'cover_image' => UploadedFile::fake()->image('shop.jpg'),
        ]);

        $response->assertRedirect(route('admin.shops.index'));

        $shop = Shop::firstWhere('name', 'Nowa Lodziarnia');
        $this->assertNotNull($shop);
        $this->assertSame('nowa-lodziarnia', $shop->slug);
        $this->assertTrue($shop->is_featured);
        Storage::disk('public')->assertExists($shop->cover_image);
    }

    public function test_admin_can_save_a_half_star_rating(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('admin.shops.store'), [
            'name' => 'Half Star Shop',
            'description' => 'Testing half stars.',
            'status' => 'visited',
            'rating' => 4.5,
        ]);

        $response->assertRedirect(route('admin.shops.index'));
        $this->assertSame(4.5, Shop::firstWhere('name', 'Half Star Shop')->rating);
    }

    public function test_rating_must_be_a_half_star_increment(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('admin.shops.store'), [
            'name' => 'Bad Rating Shop',
            'description' => 'Testing invalid ratings.',
            'status' => 'visited',
            'rating' => 4.3,
        ]);

        $response->assertSessionHasErrors('rating');
        $this->assertNull(Shop::firstWhere('name', 'Bad Rating Shop'));
    }

    public function test_admin_can_update_a_shop(): void
    {
        $user = User::factory()->create();
        $shop = Shop::factory()->create(['name' => 'Old Name']);

        $response = $this->actingAs($user)->put(route('admin.shops.update', $shop), [
            'name' => 'New Name',
            'description' => $shop->description,
            'status' => $shop->status,
        ]);

        $response->assertRedirect(route('admin.shops.index'));
        $this->assertSame('New Name', $shop->fresh()->name);
    }

    public function test_admin_can_delete_a_shop(): void
    {
        $user = User::factory()->create();
        $shop = Shop::factory()->create();

        $response = $this->actingAs($user)->delete(route('admin.shops.destroy', $shop));

        $response->assertRedirect(route('admin.shops.index'));
        $this->assertModelMissing($shop);
    }

    public function test_guest_cannot_manage_shops(): void
    {
        $shop = Shop::factory()->create();

        $this->post(route('admin.shops.store'))->assertRedirect(route('login'));
        $this->put(route('admin.shops.update', $shop))->assertRedirect(route('login'));
        $this->delete(route('admin.shops.destroy', $shop))->assertRedirect(route('login'));
    }
}
