<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product\Color;
use Illuminate\Http\Request;

class colorController extends Controller
{
    public function colorView(){
        return view('Admin.Product.Color.addColor');
    }
    public function addColor(Request $request){
        $validate = $request->validate([
            "color"=>"required",
            "code"=>"required",
        ]);
        $color = new Color();
        $color->color = $request->color;
        $color->code = $request->code;
        $color->save();
        return redirect()->route('colorList')->with('success','Color Added Successfully');
    }
    public function colorList(){
        $colors = Color::all();
        return view('Admin.Product.Color.colorList')->with('colors',$colors);
    }
    public function getColorInfo(Request $request){
        $color = Color::where('id',$request->id)->first();
        return $color;
    }
    public function deleteColor(Request $request){
        $color = Color::where('id',$request->id)->delete();
        return  redirect()->route('colorList')->with('delete','Product Category deleted Successfully');
    }
    public function updateColor(Request $request){
        $validate = $request->validate([
            "color"=>"required",
            "code"=>"required",
        ]);
        $color = Color::where('id',$request->id)->first();
        $color->color = $request->color;
        $color->code = $request->code;
        $color->save();
        return redirect()->route('colorList')->with('success','Color Update Successfully');
    }
}
