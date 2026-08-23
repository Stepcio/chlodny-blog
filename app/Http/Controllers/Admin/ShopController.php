<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreShopRequest;
use App\Http\Requests\UpdateShopRequest;
use App\Models\Shop;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ShopController extends Controller
{
    public function index(): View
    {
        return view('admin.shops.index', [
            'shops' => Shop::orderBy('name')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.shops.create', [
            'shop' => new Shop(),
        ]);
    }

    public function store(StoreShopRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['is_featured'] = $request->boolean('is_featured');
        $data['slug'] = $this->uniqueSlug($data['name']);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('shops', 'public');
        }

        Shop::create($data);

        return redirect()->route('admin.shops.index')->with('status', 'Lodziarnia dodana.');
    }

    public function edit(Shop $shop): View
    {
        return view('admin.shops.edit', [
            'shop' => $shop,
        ]);
    }

    public function update(UpdateShopRequest $request, Shop $shop): RedirectResponse
    {
        $data = $request->validated();
        $data['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('cover_image')) {
            if ($shop->cover_image) {
                Storage::disk('public')->delete($shop->cover_image);
            }

            $data['cover_image'] = $request->file('cover_image')->store('shops', 'public');
        } else {
            unset($data['cover_image']);
        }

        $shop->update($data);

        return redirect()->route('admin.shops.index')->with('status', 'Lodziarnia zaktualizowana.');
    }

    public function destroy(Shop $shop): RedirectResponse
    {
        if ($shop->cover_image) {
            Storage::disk('public')->delete($shop->cover_image);
        }

        $shop->delete();

        return redirect()->route('admin.shops.index')->with('status', 'Lodziarnia usunięta.');
    }

    private function uniqueSlug(string $name): string
    {
        $base = Str::slug($name);
        $slug = $base;
        $suffix = 2;

        while (Shop::where('slug', $slug)->exists()) {
            $slug = "{$base}-{$suffix}";
            $suffix++;
        }

        return $slug;
    }
}
