<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use Illuminate\Http\Request;

class InvoicesReport extends Controller
{
    public function index(){
        return view('reports.invoices_report');
    }
    public function search_invoices(Request $request){
        $rdio=$request->rdio;
        if($rdio==1){
            if($request->type && $request->start_at=='' && $request->end_at==''){
                $type=$request->type;
                if($type=="الكل"){
                    $invoices=invoices::all();
                    return view('reports.invoices_report',compact('type'))->withDetails($invoices);
                }else{
                    $invoices=invoices::select("*")->where("Status",$request->type)->get();
                    return view('reports.invoices_report',compact('type'))->withDetails($invoices);
                }

            }else{

                $type=$request->type;
                    $start_at=date($request->start_at);
                    $end_at=date($request->end_at);
                if($type=="الكل"){
                    $invoices=invoices::all()->whereBetween('invoice_Date',[$start_at,$end_at]);
                    return view('reports.invoices_report',compact('type','start_at','end_at'))->withDetails($invoices);
                }else{
                    $invoices=invoices::whereBetween('invoice_Date',[$start_at,$end_at])->where('Status','=',$request->type)->get();
                    return view('reports.invoices_report',compact('type','start_at','end_at'))->withDetails($invoices);
                }
                

            }
        }else{
            $invoices=invoices::select("*")->where("invoice_number",$request->invoice_number)->get();
            $invoice_number=$request->invoice_number;
            return view('reports.invoices_report',compact('invoice_number'))->withDetails($invoices);
        }
    }
}
