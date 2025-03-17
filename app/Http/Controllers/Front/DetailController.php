<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Item;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function index($slug)
    {
        $item = Item::with(['type', 'brand'])->where('slug', $slug)->firstOrFail();
        $similiarItems = Item::with(['type', 'brand'])
            // ->where('type_id', $item->type_id)
            // ->orWhere('brand_id', $item->brand_id)
            ->where('id', '!=', $item->id) // Exclude the current item
            ->take(4) // Limit to 4 similar items
            ->get();
        $faqs = Faq::latest()->take(6)->get();

        return view('front.detail', compact('item', 'similiarItems', 'faqs'));
    }
}
