<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetails extends Model
{

    public function product_category()
    {
        return $this->belongsTo(ProductCategory::class);
    }
    use HasFactory;
}
