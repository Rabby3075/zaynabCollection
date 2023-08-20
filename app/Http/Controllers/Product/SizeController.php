<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function sizeView(){
        return view('Admin.Product.Size.addSize');
    }
    public function addSize(Request $request){
        $validate = $request->validate([
            "size"=>"required",
            "height"=>"required|numeric",
            "weight"=>"nullable|numeric",
        ]);
        $size = new Size();
        if(Size::where('size',$request->size)->first()){
            return redirect()->route('sizeList')->with('failed','Size name already exist');
        }
        $size->size = $request->size;
        $size->height = $request->height;
        $size->weight = $request->weight;
        $size->save();
        return redirect()->route('sizeList')->with('success','Size Added Successfully');
    }
    public function sizeList(){
        $sizes = Size::all();
        return view('Admin.Product.Size.sizeList')->with('sizes',$sizes);
    }
    public function getSizeInfo(Request $request){
        $sizes = Size::where('id',$request->id)->first();
        return $sizes;
    }
    public function deleteSize(Request $request){
        $sizes = Size::where('id',$request->id)->delete();
        return  redirect()->route('sizeList')->with('delete','Size deleted Successfully');
    }
    public function updateSize(Request $request){
        $validate = $request->validate([
            "size"=>"required",
            "height"=>"required|numeric",
            "weight"=>"nullable|numeric",
        ]);
        $size = Size::where('id',$request->id)->first();
        if (Size::where('size',$request->size)->where('size','<>',$size->size)->first()){
            return redirect()->route('sizeList')->with('failed','Size name already exist');
        }
        $size->size = $request->size;
        $size->height = $request->height;
        $size->weight = $request->weight;
        $size->save();
        return redirect()->route('sizeList')->with('success','Size Updated Successfully');
    }
}
