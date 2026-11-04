<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductKit;
use App\Models\Category;
use App\Models\QuoteLead;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKits = ProductKit::count();
        $totalCategories = Category::count();
        $totalLeads = QuoteLead::count();
        $recentLeads = QuoteLead::with('productKit')->latest()->take(10)->get();

        return view('admin.dashboard', compact('totalKits', 'totalCategories', 'totalLeads', 'recentLeads'));
    }
}
