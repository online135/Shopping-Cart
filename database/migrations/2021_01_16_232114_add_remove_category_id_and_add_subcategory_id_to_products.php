<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Subcategory;
use App\Models\Product;

class AddRemoveCategoryIdAndAddSubcategoryIdToProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('category_id');
            $table->foreignId('subcategory_id');
        });

        $subcategory = Subcategory::getOrCreateDefaultIfNotExist();

        Product::all()->each(function($product, $index) use ($subcategory){
            $product->subcategory()->associate($subcategory);
            $product->save();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('category_id');
            $table->dropColumn('subcategory_id');
        });
    }
}
