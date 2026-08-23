<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\View\View;

class ShopController extends Controller
{
    public function index(): View
    {
        $shops = Shop::visited()
            ->orderByDesc('rating')
            ->get();

        return view('reviews.index', [
            'shops' => $shops,
        ]);
    }

    public function show(Shop $shop): View
    {
        return view('shops.show', [
            'shop' => $shop,
        ]);
    }
}
