<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use App\Models\products;
use App\Models\sections;
use Illuminate\Http\Request;

class CustomerReport extends Controller
{
    public function index(){
        $sections=sections::all();
        return view('reports.customers_report',compact('sections'));
    }
    public function customer_search(Request $request){
        if($request->Section && $request->product && $request->start_at=='' && $request->end_at ==''){
            $pro_id=products::where('section_id',$request->Section)->first()->id;
            $invoices=invoices::where('section_id',$request->Section)->where('product_id',$pro_id)->get();
            $sections=sections::all();
            return view('reports.customers_report',compact('sections'))->withDetails($invoices);
        }else{
            $start_at=date($request->start_at);
            $end_at=date($request->end_at);
            $pro_id=products::where('section_id',$request->Section)->first()->id;
            $invoices=invoices::whereBetween('invoice_Date',[$start_at,$end_at])->where('section_id',$request->Section)->where('product_id',$pro_id)->get();
            $sections=sections::all();
            return view('reports.customers_report',compact('sections'))->withDetails($invoices);
        }
    }
}
