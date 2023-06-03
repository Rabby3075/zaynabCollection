<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    public $timestamps = false;
    public function product_details()
    {
        return $this->hasMany(ProductDetails::class);
    }
    use HasFactory;
}
