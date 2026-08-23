<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\View\View;

class ShopController extends Controller
{
    public function index(): View
    {
        $visitedShops = Shop::visited()
            ->orderByDesc('rating')
            ->get();

        $wantToVisitShops = Shop::where('status', 'want_to_visit')
            ->orderBy('name')
            ->get();

        return view('shops.index', [
            'visitedShops' => $visitedShops,
            'wantToVisitShops' => $wantToVisitShops,
        ]);
    }

    public function show(Shop $shop): View
    {
        return view('shops.show', [
            'shop' => $shop,
        ]);
    }
}
