<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductKit extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'badge',
        'estimated_price',
        'specs_summary',
        'description',
        'image_url',
        'features',
        'includes_installation',
        'is_active',
    ];

    protected $casts = [
        'features' => 'array',
        'includes_installation' => 'boolean',
        'is_active' => 'boolean',
        'estimated_price' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
