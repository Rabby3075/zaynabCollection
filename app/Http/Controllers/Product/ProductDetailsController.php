<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product\ProductCategory;
use App\Models\Product\ProductDetails;
use Illuminate\Http\Request;

class ProductDetailsController extends Controller
{
    public function addProductDetailsView(){
        $productCategory = ProductCategory::all();
        return view('Admin.Product.ProductDetails.addProductDetails')->with('categories',$productCategory);
    }
    public function addProductDetails(Request $request){
        $validate = $request->validate([
            "name"=>"required",
            "category"=>"required",
            "price"=>"required|numeric|gt:0",
            "quantity"=>"required|numeric|gt:0",
            "image"=>"required|photo_count:3,5",
            "image.*"=>'image|mimes:jpeg,png,jpg,gif,svg',
        ],
            ['image.photo_count'=>'Minimum 3 and maximum 5 photos should upload']
        );
        $images = [];
        foreach ($request->file('image') as $image) {
            $image = $image->getClientOriginalName();
            $images[] = $image;
        }
        $product = new ProductDetails();
        $product->productName = $request->name;
        $product->product_category_id = $request->category;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->image = json_encode($images);
        $product->status = 1;
        $product->details = $request->details;
        $product->rating = 5;
        $result = $product->save();
        if ($result){
            foreach ($request->file('image') as $image) {
                $imageName = $image->getClientOriginalName();
                $image->move(public_path('ProductImage'), $imageName);
            }
            return redirect()->route('productList')->with('success','Product Inserted Successfully');

        }
        else{
            return redirect()->route('productList')->with('failed','Failed to insert Product');
        }

    }
    public function productList(){
        $productCategory = ProductCategory::all();
        $products = ProductDetails::all();

        return view('Admin.Product.ProductDetails.productDetailsList')->with('categories',$productCategory)->with('products',$products);
    }
    public function getProductDetailsInfo(Request $request){
        $product = ProductDetails::where('id',$request->id)->first();
        return $product;
    }
    public function productDelete(Request $request){
        $product = ProductDetails::where('id',$request->id)->delete();
        return redirect()->route('productList')->with('delete','Product deleted Successfully');
    }
    public function editProduct(Request $request){
        $validate = $request->validate([
            "name"=>"required",
            "category"=>"required",
            "price"=>"required|numeric|gt:0",
            "quantity"=>"required|numeric|gt:0",
        ]);
        $product = ProductDetails::where('id',$request->id)->first();
        $product->productName = $request->name;
        $product->category = $request->category;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->status = $request->status;
        $product->details = $request->details;
        $result = $product->save();
        if ($result){
            return redirect()->route('productList')->with('success','Product Updated Successfully');
        }
        else{
            return redirect()->route('productList')->with('failed','Failed to update Product');
        }
    }
}
