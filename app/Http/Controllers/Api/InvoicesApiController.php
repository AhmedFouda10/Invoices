<?php

namespace App\Http\Controllers\Api;

use App\Models\invoices;
use Illuminate\Http\Request;
use App\Models\invoices_details;
use App\Http\Controllers\Controller;
use App\Models\invoices_attachments;
use Illuminate\Support\Facades\Storage;

class InvoicesApiController extends Controller
{
    public function index(){
        $invoices=invoices::all();
        return response()->json([
            "status" => 200,
            "data" => $invoices,
        ]);
    }
    public function store(Request $request){
        $invoices=new invoices();
        $invoices->invoice_number=$request->invoice_number;
        $invoices->invoice_Date=$request->invoice_Date;
        $invoices->Due_date=$request->Due_date;
        $invoices->section_id=$request->Section;
        $invoices->product=$request->product;
        $invoices->Amount_collection=$request->Amount_collection;
        $invoices->Amount_Commission=$request->Amount_Commission;
        $invoices->Discount=$request->Discount;
        $invoices->Rate_VAT=$request->Rate_VAT;
        $invoices->Value_VAT=$request->Value_VAT;
        $invoices->Total=$request->Total;
        $invoices->note=$request->note;
        $invoices->Status="غير مدفوعة";
        $invoices->Value_Status=2;
        $invoices->save();


        $invoices_id=invoices::latest()->first()->id;
        $invoices_details=new invoices_details();
        $invoices_details->id_Invoice=$invoices_id;
        $invoices_details->invoice_number=$request->invoice_number;
        $invoices_details->product=$request->product;
        $invoices_details->Section=$request->Section;
        $invoices_details->Status="غير مدفوعة";
        $invoices_details->Value_Status=2;
        $invoices_details->note=$request->note;
        $invoices_details->user="ahmed";
        $invoices_details->save();
        
    
        if($request->hasFile('pic')){
            $invoices_id=invoices::latest()->first()->id;
            $invoice_number=$request->invoice_number;
            $invoices_attachments=new invoices_attachments();
            $file=$request->pic;
            
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('attachments/'.$invoice_number,$filename);
            $invoices_attachments->file_name=$filename;

            $invoices_attachments->invoice_number=$invoice_number;
            $invoices_attachments->Created_by="ahmed";
            $invoices_attachments->invoice_id=$invoices_id;
            $invoices_attachments->save();


        }

        return response()->json([
            'message' => 'succesfully inserted',
            'status' =>201,
            "data" => $invoices,
        ]);
    }

    public function update(Request $request){
        $invoices=invoices::find($request->invoices_id);
        $invoices->invoice_number=$request->invoice_number;
        $invoices->invoice_Date=$request->invoice_Date;
        $invoices->Due_date=$request->Due_date;
        $invoices->section_id=$request->Section;
        $invoices->product=$request->product;
        $invoices->Amount_collection=$request->Amount_collection;
        $invoices->Amount_Commission=$request->Amount_Commission;
        $invoices->Discount=$request->Discount;
        $invoices->Rate_VAT=$request->Rate_VAT;
        $invoices->Value_VAT=$request->Value_VAT;
        $invoices->Total=$request->Total;
        $invoices->note=$request->note;
        $invoices->update();

        $invoices_details=invoices_details::where('id_Invoice',$request->invoices_id)->first();
        $invoices_details->id_Invoice=$request->invoices_id;
        $invoices_details->invoice_number=$request->invoice_number;
        $invoices_details->product=$request->product;
        $invoices_details->Section=$request->Section;
        $invoices_details->note=$request->note;
        $invoices_details->user="ahmed";
        $invoices_details->update();
        return response()->json([
            "msg"=>"successfully updated",
            "status"=>201,
            "data" => $invoices,
        ]);
    }

    public function destroy(Request $request)
    {
        $invoices=invoices::find($request->invoice_id);
        $invoices_attachments=invoices_attachments::where('invoice_id',$request->invoice_id)->first();
        if(!empty($invoices_attachments->invoice_number)){
            // Storage::disk('public_uploads')->delete($invoices_attachments->invoice_number.'/'.$invoices_attachments->file_name); // حذف الصوره فقط
            Storage::disk('public_uploads')->deleteDirectory($invoices_attachments->invoice_number); // حذف من الفولدر الاساسي كله
        }
        $invoices->forceDelete();
        return response()->json([
            "msg"=>"successfully deleted",
            "status"=>201,
        ]);
        
    }
}
