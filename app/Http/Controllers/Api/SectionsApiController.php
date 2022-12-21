<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionsApiController extends Controller
{
    public function index(){
        // $sections=sections::all();
        $sections=sections::select('id','section_name as section_name_'.app()->getLocale(),'description as description_'.app()->getLocale())->get();
        return response()->json([
            "status" => 200,
            "data" => $sections,
        ]);
    }
    public function store(Request $request){
        // $validated = $request->validate([
        //     'section_name_en' => 'required|unique:sections|max:255',
        //     'description_en' => 'required',
        //     'section_name_ar' => 'required|unique:sections|max:255',
        //     'description_ar' => 'required',
        // ],[
        //     'section_name_en.required' =>'يرجي ادخال اسم القسم',
        //     'section_name_ar.required' =>'يرجي ادخال اسم القسم',
        //     'section_name_en.unique' =>'اسم القسم مسجل مسبقا',
        //     'section_name_ar.unique' =>'اسم القسم مسجل مسبقا',
        //     'description_en.required' =>'يرجي ادخال وصف القسم ',
        //     'description_ar.required' =>'يرجي ادخال وصف القسم '
        // ]);
        $sections=new sections();
        // $sections->section_name=['en'=>$request->section_name_en,'ar'=>$request->section_name_ar];
        $sections->section_name=["$request->section_name_".app()->getLocale(),app()->getLocale()];
        // $sections->description=['en'=>$request->description_en,'ar'=>$request->description_ar];
        $sections->description='description_'.app()->getLocale().' as description';
        $sections->Created_by="ahmed";
        $sections->save();
        return response()->json([
            'message' => 'succesfully inserted',
            'status' =>201,
            'data'=>$sections,

        ]);
    }

    public function update(Request $request){
        $id= $request->id;
        $validated = $request->validate([
            'section_name' => 'required|max:255|unique:sections,section_name,'.$id,
            'description' => 'required',
        ],[
            'section_name.required' =>'يرجي ادخال اسم القسم',
            'section_name.unique' =>'اسم القسم مسجل مسبقا',
            'description.required' =>'يرجي ادخال وصف القسم '
        ]);

        $sections=sections::find($id);
        $sections->section_name=$request->section_name;
        $sections->description=$request->description;
        $sections->update();
        return response()->json([
            "msg"=>"successfully updated",
            "status"=>201,
            'data'=>$sections,
        ]);
    }
    
    public function destroy(Request $request){
        $sections=sections::find($request->id);
        $sections->delete();
        return response()->json([
            "msg"=>"successfully deleted",
            "status"=>201,
        ]);
    }
}
