<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'price',
        'description',
        'width',
        'height',
        'weight',
        'featured',
        'availability_status',
        'image_path',

    ];

     protected $casts = [
        'featured' => 'boolean',
        'image_path' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

   public function getImageUrlAttribute(): ?string
    {
        return isset($this->image_path[0])
            ? asset('storage/' . $this->image_path[0])
            : null;
    }

    protected static function booted()
    {
        static::creating(function ($product) {
            // Generate a basic slug from the product name
            $slug = \Str::slug($product->name);

            // Append the current timestamp to the slug for uniqueness
            $product->slug = $slug . '-' . now()->timestamp;
    });
}
}