<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteLead extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_kit_id',
        'customer_name',
        'customer_phone',
        'property_type',
        'camera_count',
        'requires_installation',
        'extra_services',
        'message_payload',
        'status',
    ];

    public function productKit()
    {
        return $this->belongsTo(ProductKit::class);
    }
}
