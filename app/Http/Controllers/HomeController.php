<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $featuredShops = Shop::featured()
            ->orderByDesc('rating')
            ->get();

        return view('home', [
            'featuredShops' => $featuredShops,
        ]);
    }
}
