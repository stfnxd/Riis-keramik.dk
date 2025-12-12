<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
        protected static function booted()
    {
        static::creating(function ($category) {
            // Generate a basic slug from the product name
            $slug = \Str::slug($category->name);

            // Append the current timestamp to the slug for uniqueness
            $category->slug = $slug;
        });

    }
}