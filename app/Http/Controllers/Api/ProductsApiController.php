<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\products;
use App\Models\sections;
use Illuminate\Http\Request;

class ProductsApiController extends Controller
{
    public function index(){
        $products=products::all();
        $sections=sections::all();
        return response()->json([
            "status" => 200,
            "data" => [$products,$sections],
        ]);
    }
    public function store(Request $request){
        $validate=$request->validate([
            "Product_name"=>"required|max:255|unique:products",
            "section_id"=>"required",
            "description"=>"required",
        ],[
            "Product_name.required"=>"يرجي ادخال اسم المنتج",
            "Product_name.unique"=>"اسم النتج مسجل مسبقا",
            "section_id.required"=>"يرجي ادخال اسم القسم",
            "description.required"=>"يرجي ادخال وصف المنتج",
        ]);
        $products=new products();
        $products->Product_name=$request->Product_name;
        $products->section_id=$request->section_id;
        $products->description=$request->description;
        $products->save();
        return response()->json([
            'message' => 'succesfully inserted',
            'status' =>201,
            'data'=>$products,

        ]);
    }

    public function update(Request $request){
        $id= sections::where("section_name",$request->section_name)->first()->id;
        // echo $id;die;
        $pro_id=$request->pro_id;
        $validate=$request->validate([
            "Product_name"=>'required|max:255|unique:products,Product_name,'.$pro_id,
            "section_name"=>"required",
            "description"=>"required",
        ],[
            "Product_name.required"=>"يرجي ادخال اسم النتج",
            "Product_name.unique"=>"اسم المنتج مسجل مسبقا",
            "section_name.required"=>"يرجي ادخال اسم القسم",
            "description.required"=>"يرجي ادخال وصف المنتج",
        ]);
        
        $products=products::find($pro_id);
        $products->Product_name=$request->Product_name;
        $products->section_id=$id;
        $products->description=$request->description;
        $products->update();
        return response()->json([
            "msg"=>"successfully updated",
            "status"=>201,
            'data'=>$products,
        ]);
    }
    public function destroy(Request $request){
        $products=products::find($request->pro_id);
        $products->delete();
        return response()->json([
            "msg"=>"successfully deleted",
            "status"=>201,
        ]);
    }
}
