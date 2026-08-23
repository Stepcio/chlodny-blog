<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\View\View;

class WishlistController extends Controller
{
    public function index(): View
    {
        $shops = Shop::where('status', 'want_to_visit')
            ->orderBy('name')
            ->get();

        return view('wishlist.index', [
            'shops' => $shops,
        ]);
    }
}
