<?php

namespace App\Http\Controllers;

use App\Models\invoices_attachments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoicesAttachmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $validate=$request->validate([
            'file_name'=>'mimes:pdf,jpeg,png,jpg',
        ],[
            'file_name.mimes'=> 'صيغه المرفق يجب ان تكون pdf , jpeg , png , jpg',
        ]);
        $invoice_number=$request->invoice_number;
        $file=$request->file_name;
        $extension=$file->getClientOriginalExtension();
        $filename=time().rand(0,1000000).'.'.$extension;
        $file->move('attachments/'.$invoice_number,$filename);
        $invoices_attachments=new invoices_attachments();
        $invoices_attachments->file_name=$filename;
        $invoices_attachments->invoice_number=$invoice_number;
        $invoices_attachments->invoice_id=$request->invoice_id;
        $invoices_attachments->Created_by=Auth::user()->name;
        $invoices_attachments->save();
        return back()->with("Add","تم اضافه مرفق جديد بنجاح");


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices_attachments  $invoices_attachments
     * @return \Illuminate\Http\Response
     */
    public function show(invoices_attachments $invoices_attachments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices_attachments  $invoices_attachments
     * @return \Illuminate\Http\Response
     */
    public function edit(invoices_attachments $invoices_attachments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices_attachments  $invoices_attachments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices_attachments $invoices_attachments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices_attachments  $invoices_attachments
     * @return \Illuminate\Http\Response
     */
    public function destroy(invoices_attachments $invoices_attachments)
    {
        //
    }
}
