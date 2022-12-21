<?php

namespace App\Http\Controllers;

use App\Models\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections=sections::all();
        return view('sections.sections' ,compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 1- away
        // $validated = $request->validate([
        //     'section_name' => 'required|unique:sections|max:255',
        //     'description' => 'required',
        // ],[
        //     'section_name.required' =>'يرجي ادخال اسم القسم',
        //     'section_name.unique' =>'اسم القسم مسجل مسبقا',
        //     'description.required' =>'يرجي ادخال وصف القسم '
        // ]);

            $sections=new sections();
            $sections->section_name=['en'=>$request->section_name_en,'ar'=>$request->section_name_ar];
            $sections->description=['en'=>$request->description_en,'ar'=>$request->description_ar];
            $sections->Created_by=Auth::user()->name;
            $sections->save();
            return redirect('/sections/all')->with('Add','تم اضافه القسم بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function show(sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function edit(sections $sections)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id= $request->id;
        // $validated = $request->validate([
        //     'section_name' => 'required|max:255|unique:sections,section_name,'.$id,
        //     'description' => 'required',
        // ],[
        //     'section_name.required' =>'يرجي ادخال اسم القسم',
        //     'section_name.unique' =>'اسم القسم مسجل مسبقا',
        //     'description.required' =>'يرجي ادخال وصف القسم '
        // ]);

        $sections=sections::find($id);
        $sections->section_name=['en'=>$request->section_name_en,'ar'=>$request->section_name_ar];
        $sections->description=['en'=>$request->description_en,'ar'=>$request->description_ar];
        $sections->update();
        return redirect('/sections/all')->with('edit','تم تعديل القسم بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $sections=sections::find($request->id);
        $sections->delete();
        return redirect('/sections/all')->with('delete','تم حذف القسم بنجاح');
    }
}
