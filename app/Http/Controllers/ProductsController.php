<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\sections;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=products::all();
        $sections=sections::all();
        return view('products.products',compact('sections','products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validate=$request->validate([
        //     "Product_name"=>"required|max:255|unique:products",
        //     "section_id"=>"required",
        //     "description"=>"required",
        // ],[
        //     "Product_name.required"=>"يرجي ادخال اسم المنتج",
        //     "Product_name.unique"=>"اسم النتج مسجل مسبقا",
        //     "section_id.required"=>"يرجي ادخال اسم القسم",
        //     "description.required"=>"يرجي ادخال وصف المنتج",
        // ]);
        $products=new products();
        // $products->Product_name=$request->Product_name;
        $products->Product_name=['en'=>$request->Product_name_en,'ar'=>$request->Product_name_ar];
        $products->section_id=$request->section_id;
        $products->description=['en'=>$request->description_en,'ar'=>$request->description_ar];
        $products->save();
        return redirect('/products/all')->with('Add','تم اضافه المنتج بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $pro_id=$request->pro_id;
        // $validate=$request->validate([
        //     "Product_name"=>'required|max:255|unique:products,Product_name,'.$pro_id,
        //     "section_name"=>"required",
        //     "description"=>"required",
        // ],[
        //     "Product_name.required"=>"يرجي ادخال اسم النتج",
        //     "Product_name.unique"=>"اسم المنتج مسجل مسبقا",
        //     "section_name.required"=>"يرجي ادخال اسم القسم",
        //     "description.required"=>"يرجي ادخال وصف المنتج",
        // ]);
        
        $products=products::find($pro_id);
        // $products->Product_name=$request->Product_name;
        $products->Product_name=['en'=>$request->Product_name_en,'ar'=>$request->Product_name_ar];
        $products->section_id=$request->section_name;
        $products->description=['en'=>$request->description_en,'ar'=>$request->description_ar];
        $products->update();
        return redirect('/products/all')->with('edit','تم تعديل المنتج بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $products=products::find($request->pro_id);
        $products->delete();
        return redirect('/products/all')->with('delete','تم حذف المنتج بنجاح');

    }
}
