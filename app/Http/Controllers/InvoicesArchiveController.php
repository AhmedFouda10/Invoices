<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use App\Models\invoices_archive;
use Illuminate\Http\Request;

class InvoicesArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices=invoices::onlyTrashed()->get();
        return view("invoices.invoices_archieve",compact('invoices'));
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
     * @param  \App\Models\invoices_archive  $invoices_archive
     * @return \Illuminate\Http\Response
     */
    public function show(invoices_archive $invoices_archive)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices_archive  $invoices_archive
     * @return \Illuminate\Http\Response
     */
    public function edit(invoices_archive $invoices_archive)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices_archive  $invoices_archive
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $invoices=invoices::withTrashed()->where('id',$request->invoice_id)->restore();
        return redirect('invoices')->with("invoices_restore");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices_archive  $invoices_archive
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request )
    {
        $invoices=invoices::withTrashed()->where('id',$request->invoice_id)->first();
        $invoices->forceDelete();
        return redirect('invoices')->with('delete_invoice');
    }
}
