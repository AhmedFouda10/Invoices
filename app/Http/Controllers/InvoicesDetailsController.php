<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use App\Models\invoices_attachments;
use App\Models\invoices_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class InvoicesDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id=$request->id;
        $invoices=invoices::where('id',$id)->first();
        $invoices_details=invoices_details::where('id_Invoice',$id)->get();
        $invoices_attachments=invoices_attachments::where('invoice_id',$id)->get();


        // $invoices_details=DB::table("invoices_details")->where("id_Invoice",$id)->get();
        return view('invoices.invoices_details',compact('invoices','invoices_details','invoices_attachments'));
         
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function show(invoices_details $invoices_details)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function edit(invoices_details $invoices_details)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices_details $invoices_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $invoices_attachments=invoices_attachments::find($request->id_file);
        $invoices_attachments->delete();
        Storage::disk('public_uploads')->delete($request->invoice_number.'/'.$request->file_name);
        return back()->with('delete','تم حذف المرفق بنجاح');
    }
    public function openFile($invoice_number,$file_name){
        $files=Storage::disk('public_uploads')->path($invoice_number.'/'.$file_name);
        return response()->file($files);
    }
    public function downloadFile($invoice_number,$file_name){
        $files=Storage::disk('public_uploads')->path($invoice_number.'/'.$file_name);
        return response()->download($files);
    }
}
