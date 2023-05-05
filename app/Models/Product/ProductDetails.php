<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetails extends Model
{
    use HasFactory;
    public function category()
    {
        return $this->belongsTo(ProductCategory::class,'category');
    }
}
