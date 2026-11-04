<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ProductKit;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active', true)->with('productKits')->get();
        $kits = ProductKit::where('is_active', true)->with('category')->latest()->get();

        return view('home', compact('categories', 'kits'));
    }
}
