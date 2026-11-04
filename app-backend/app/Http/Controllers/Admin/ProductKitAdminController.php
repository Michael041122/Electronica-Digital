<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductKit;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductKitAdminController extends Controller
{
    public function index()
    {
        $kits = ProductKit::with('category')->latest()->paginate(15);
        return view('admin.kits.index', compact('kits'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.kits.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:150',
            'badge' => 'nullable|string|max:50',
            'estimated_price' => 'nullable|numeric|min:0',
            'specs_summary' => 'required|string',
            'description' => 'nullable|string',
            'image_url' => 'nullable|url|max:255',
            'features_text' => 'nullable|string',
            'includes_installation' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        $features = [];
        if (!empty($validated['features_text'])) {
            $features = array_filter(array_map('trim', explode("\n", $validated['features_text'])));
        }

        ProductKit::create([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']) . '-' . rand(100, 999),
            'badge' => $validated['badge'] ?? null,
            'estimated_price' => $validated['estimated_price'] ?? null,
            'specs_summary' => $validated['specs_summary'],
            'description' => $validated['description'] ?? null,
            'image_url' => $validated['image_url'] ?? 'https://images.unsplash.com/photo-1557597774-9d273605dfa9?auto=format&fit=crop&w=600&q=80',
            'features' => $features,
            'includes_installation' => $request->has('includes_installation'),
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.kits.index')->with('success', 'Kit de seguridad registrado exitosamente.');
    }

    public function edit(ProductKit $kit)
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.kits.edit', compact('kit', 'categories'));
    }

    public function update(Request $request, ProductKit $kit)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:150',
            'badge' => 'nullable|string|max:50',
            'estimated_price' => 'nullable|numeric|min:0',
            'specs_summary' => 'required|string',
            'description' => 'nullable|string',
            'image_url' => 'nullable|url|max:255',
            'features_text' => 'nullable|string',
            'includes_installation' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        $features = [];
        if (!empty($validated['features_text'])) {
            $features = array_filter(array_map('trim', explode("\n", $validated['features_text'])));
        }

        $kit->update([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'badge' => $validated['badge'] ?? null,
            'estimated_price' => $validated['estimated_price'] ?? null,
            'specs_summary' => $validated['specs_summary'],
            'description' => $validated['description'] ?? null,
            'image_url' => $validated['image_url'] ?? $kit->image_url,
            'features' => $features,
            'includes_installation' => $request->has('includes_installation'),
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.kits.index')->with('success', 'Kit actualizado correctamente.');
    }

    public function destroy(ProductKit $kit)
    {
        $kit->delete();
        return redirect()->route('admin.kits.index')->with('success', 'Kit eliminado correctamente.');
    }
}
