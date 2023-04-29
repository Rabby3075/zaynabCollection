<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function products()
    {
        return $this->hasMany(ProductDetails::class)->onDelete('cascade');
    }
}
