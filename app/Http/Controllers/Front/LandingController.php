<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::with(['type', 'brand'])->latest()->take(4)->get()->reverse();
        return view('front.landing', compact('items'));
    }
}
