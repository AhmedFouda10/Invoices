<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\invoices;
use App\Models\products;
use App\Models\sections;
use Illuminate\Http\Request;
use App\Exports\InvoicesExport;
use App\Models\invoices_details;
use App\Notifications\AddInvoice;
use Illuminate\Support\Facades\DB;
use App\Models\invoices_attachments;
use App\Notifications\Add_Invoice_New;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices=invoices::all();
        return view('invoices.invoices' , compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $products=products::all();
        $sections=sections::all();
        return view('invoices.add_invoices',compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $invoices=new invoices();
        $invoices->invoice_number=$request->invoice_number;
        $invoices->invoice_Date=$request->invoice_Date;
        $invoices->Due_date=$request->Due_date;
        $invoices->section_id=$request->Section;
        $section_id=$invoices->section_id;
        $id_pro=products::where('section_id',$section_id)->first()->id;
        $invoices->product_id=$id_pro;
        $invoices->Amount_collection=$request->Amount_collection;
        $invoices->Amount_Commission=$request->Amount_Commission;
        $invoices->Discount=$request->Discount;
        $invoices->Rate_VAT=$request->Rate_VAT;
        $invoices->Value_VAT=$request->Value_VAT;
        $invoices->Total=$request->Total;
        $invoices->note=['en'=>$request->note_en,'ar'=>$request->note_ar];
        $invoices->Status="غير مدفوعة";
        $invoices->Value_Status=2;
        $invoices->save();


        $invoices_id=invoices::latest()->first()->id;
        $invoices_details=new invoices_details();
        $invoices_details->id_Invoice=$invoices_id;
        $invoices_details->invoice_number=$request->invoice_number;
        $invoices_details->product_id=$id_pro;
        $invoices_details->Section=$request->Section;
        $invoices_details->Status="غير مدفوعة";
        $invoices_details->Value_Status=2;
        $invoices_details->note=['en'=>$request->note_en,'ar'=>$request->note_ar];
        $invoices_details->user=Auth::user()->name;
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
            $invoices_attachments->Created_by=Auth::user()->name;
            $invoices_attachments->invoice_id=$invoices_id;
            $invoices_attachments->save();

        }

        // $user=User::first();
        // Notification::send($user,new AddInvoice($invoices_id));

        $user=User::get();
        $invoices=invoices::latest()->first();
        Notification::send($user,new Add_Invoice_New($invoices));


        return redirect('invoices')->with("Add","تم اضافه فاتوره بنجاح");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $status_show=invoices::find($request->id);
        return view('invoices.status_show',compact('status_show'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoices=invoices::find($id);
        $sections=sections::all();
        return view('invoices.edit_invoices' , compact('invoices','sections'));   
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $invoices=invoices::find($request->invoices_id);
        $invoices->invoice_number=$request->invoice_number;
        $invoices->invoice_Date=$request->invoice_Date;
        $invoices->Due_date=$request->Due_date;
        $invoices->section_id=$request->Section;
        $section_id=$invoices->section_id;
        $id_pro=products::where('section_id',$section_id)->first()->id;
        $invoices->product_id=$id_pro;
        $invoices->Amount_collection=$request->Amount_collection;
        $invoices->Amount_Commission=$request->Amount_Commission;
        $invoices->Discount=$request->Discount;
        $invoices->Rate_VAT=$request->Rate_VAT;
        $invoices->Value_VAT=$request->Value_VAT;
        $invoices->Total=$request->Total;
        $invoices->note=['en'=>$request->note_en,'ar'=>$request->note_ar];
        $invoices->update();

        $invoices_details=invoices_details::where('id_Invoice',$request->invoices_id)->first();
        $invoices_details->id_Invoice=$request->invoices_id;
        $invoices_details->invoice_number=$request->invoice_number;
        $invoices_details->product_id=$id_pro;
        $invoices_details->Section=$request->Section;
        $invoices_details->note=['en'=>$request->note_en,'ar'=>$request->note_ar];
        $invoices_details->user=Auth::user()->name;
        $invoices_details->update();

        // if($request->hasFile('pic')){
        //     $invoices_attachments=invoices_attachments::where('invoice_id',$request->invoices_id)->first();
        //     $file=$request->pic;
        //     $extension=$file->getClientOriginalExtension();
        //     $filename=time().rand(0,1000000).'.'.$extension;
        //     $file->move("attachments/".$request->invoice_number,$filename);

        //     $invoices_attachments->file_name=$filename;
        //     $invoices_attachments->invoice_number=$request->invoice_number;
        //     $invoices_attachments->Created_by=Auth::user()->name;
        //     $invoices_attachments->invoice_id=$request->invoices_id;
        //     $invoices_attachments->update();
        // }else{
        //     $invoices_attachments=invoices_attachments::where('invoice_id',$request->invoices_id);   
        //     $invoices_attachments->invoice_number=$request->invoice_number;
        //     $invoices_attachments->Created_by=Auth::user()->name;
        //     $invoices_attachments->invoice_id=$request->invoices_id;
        //     $invoices_attachments->update();
        // }
        return redirect('invoices')->with("edit","تم تعديل الفاتوره بنجاح");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $invoices=invoices::find($request->invoice_id);
        $invoices_attachments=invoices_attachments::where('invoice_id',$request->invoice_id)->first();
        if(!empty($invoices_attachments->invoice_number)){
            // Storage::disk('public_uploads')->delete($invoices_attachments->invoice_number.'/'.$invoices_attachments->file_name); // حذف الصوره فقط
            Storage::disk('public_uploads')->deleteDirectory($invoices_attachments->invoice_number); // حذف من الفولدر الاساسي كله
        }
        $invoices->forceDelete();
        // $invoices->Delete();
        return redirect('invoices')->with("delete_invoice");
    }

    public function getProducts($id){
        // $products=DB::table("products")->where("section_id",$id)->pluck("Product_name","id");
        // return json_encode($products);


        $products=products::where("section_id",$id)->pluck("Product_name","id");
        return json_encode($products);

    }
    public function status_update(Request $request){
        if($request->Status=="مدفوعة"){
            $invoices=invoices::findOrFail($request->id);
            $invoices->Status=$request->Status;
            $invoices->Value_Status='1';
            $invoices->Payment_Date=$request->Payment_Date;
            $invoices->update();

            $invoices_details=new invoices_details();
            $invoices_details->id_Invoice=$request->id;
            $invoices_details->invoice_number=$request->invoice_number;
            $invoices_details->product_id=$request->product;
            $invoices_details->Section=$request->Section;
            $invoices_details->Status=$request->Status;
            $invoices_details->Value_Status="1";
            $invoices_details->Payment_Date=$request->Payment_Date;
            $invoices_details->note=['en'=>$request->note_en,'ar'=>$request->note_ar];
            $invoices_details->user=Auth::user()->name;
            $invoices_details->save();
        }else{
            $invoices=invoices::findOrFail($request->id);
            $invoices->Status=$request->Status;
            $invoices->Value_Status='3';
            $invoices->Payment_Date=$request->Payment_Date;
            $invoices->update();

            $invoices_details=new invoices_details();
            $invoices_details->id_Invoice=$request->id;
            $invoices_details->invoice_number=$request->invoice_number;
            $invoices_details->product_id=$request->product;
            $invoices_details->Section=$request->Section;
            $invoices_details->Status=$request->Status;
            $invoices_details->Value_Status="3";
            $invoices_details->Payment_Date=$request->Payment_Date;
            $invoices_details->note=['en'=>$request->note_en,'ar'=>$request->note_ar];
            $invoices_details->user=Auth::user()->name;
            $invoices_details->save();

        }
        return redirect('invoices')->with('status_update');
    }

    public function invoice_paid(){
        $invoices=invoices::where("Value_Status",1)->get();
        return view('invoices.invoices_Paid',compact('invoices'));
    }
    public function invoice_unpaid(){
        $invoices=invoices::where("Value_Status",2)->get();
        return view('invoices.invoices_unPaid',compact('invoices'));
    }
    public function invoice_partialpaid(){
        $invoices=invoices::where("Value_Status",3)->get();
        return view('invoices.invoices_Partial_Paid',compact('invoices'));
    }
    public function invoices_archieves_done(Request $request){
        $invoices=invoices::find($request->invoice_id);
        $invoices->delete();
        return redirect('invoice/archive')->with('success','تم نقل الفاتوره الي الارشيف بنجاح');
    }
    public function print_invoices(Request $request){
        $invoices=invoices::where('id',$request->id)->first();
        return view('invoices.print_invoices',compact('invoices')); 
    }
    public function export() 
    {
        return Excel::download(new InvoicesExport, 'قائمه_الفواتير.xlsx');
    }
    public function MarkAsReadAll(){
        $userUnreadNotification=Auth::user()->unreadNotifications;
        if($userUnreadNotification){
            $userUnreadNotification->MarkAsRead();
            return back();
        }
    }
    public function invoice_search(Request $request){
        $outputs=null;
        $invoices=invoices::where("product","LIKE","%".$request->product."%")->get();
        foreach($invoices as $invoice){
            $outputs .='<ul>
                <li>'.$invoice->product.'</li>
            </ul>';
        }
        return response($outputs);
        

    }
    public function test(Request $request){
        echo "test";
    }
}
