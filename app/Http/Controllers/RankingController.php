<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\View\View;

class RankingController extends Controller
{
    public function index(): View
    {
        $shops = Shop::featured()
            ->orderByDesc('rating')
            ->get();

        return view('rankings.index', [
            'shops' => $shops,
        ]);
    }
}
