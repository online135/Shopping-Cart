<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'image_url',
        'brand_name',
        'category_name'
    ];

    use HasFactory;

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function category_name() {
        return @$this->category->name ?: "Default";
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }
}
