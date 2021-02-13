<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'category_id', 'is_default'];

    static public function getDefault()
    {
        return self::where('is_default', true)->first();
    }

    static public function getOrCreateDefaultIfNotExist()
    {
        $default = self::getDefault();
        if (is_null($default)){
            $category = Category::getOrCreateDefaultIfNotExist();
            $default = Subcategory::create([
                'name' => '未分類',
                'is_default' => true,
                'category_id' => $category->id
            ]);
        }
        return $default;
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
