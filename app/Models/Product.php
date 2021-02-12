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

    public function categoriesList() {
        $categories = [];
        $tmp = $this->category;
        while(!is_null($tmp)) {
            array_unshift($categories, $tmp);
            $tmp = $tmp->parent;
        }
        return $categories;
    }

    public function tags() {
        return $this->belongsToMany(Tag::class, 'product_tag')
                    ->using(ProductTag::class)
                    ->withPivot(['enabled'])
                    ->withTimestamps();
    }

    public function enabledRelatedTags() {
        return $this->belongsToMany(Tag::class, 'product_tag')
                    ->using(ProductTag::class)
                    ->withPivot(['enabled', 'order_index'])
                    ->withTimestamps()
                    ->wherePivot('enabled', true)
                    ->orderByPivot('order_index', 'desc');
    }
}
