<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function addProductCategoryView(){
        return view('Admin.Product.ProductCategory.addProductCategory');
    }
    public function addProductCategory(Request $request){
        $validate = $request->validate([
            "name"=>"required",
        ]);
        $productCategory = new ProductCategory();
        $productCategory->categoryName = $request->name;
        $result = $productCategory->save();
        if($result){
            return redirect()->route('productCategoryList')->with('success','Product Category Inserted Successfully');
        }
        else{
            return redirect()->route('productCategoryList')->with('failed','Failed to insert product category');
        }
    }
    public function productCategoryList(){
        $productCategory = ProductCategory::all();
        return view('Admin.Product.ProductCategory.productCategoryList')->with('categories',$productCategory);
    }
    public function getProductCategoryInfo(Request $request){
        $productCategory = ProductCategory::where('id',$request->id)->first();
        return $productCategory;
    }
    public function deleteProductCategory(Request $request){
        $productCategory = ProductCategory::where('id',$request->id)->delete();
        return  redirect()->route('productCategoryList')->with('success','Product Category deleted Successfully');
    }
    public function editProductCategory(Request $request){
        $validate = $request->validate([
            "name"=>"required",
        ]);
        $productCategory = ProductCategory::where('id',$request->id)->first();
        $productCategory->categoryName = $request->name;
        $productCategory->save();
        return  redirect()->route('productCategoryList')->with('success','Product Category updated Successfully');
    }

}
