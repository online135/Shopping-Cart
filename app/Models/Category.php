<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    use HasFactory;

    static public function getDefault(){
        return self::first();
    }

    static public function getOrCreateDefaultIfNotExist(){
        $default = self::getDefault();
        if (is_null($default)){
            $default = Category::create([
                'name' => '未分類',
            ]);
        }
        return $default;
    }


    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }

    public function product()
    {
        return $this->hasOneThrough(
            Product::class,  // 1
            Subcategory::class,  // 2
            'category_id',   // 2 
            'subcategory_id', // 1
            'id',   // 1
            'id'    // 2
        );
    }
}
