<?php

namespace App\Http\Livewire;

use App\Models\products;
use App\Models\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AddInvoive extends Component
{
    public $currentStep=1,
     $invoice_number,
     $invoice_Date,
     $Due_date,
     $Section,
     $product,
     $Amount_collection,
     $Amount_Commission,
     $Discount,
     $Rate_VAT,
     $Value_VAT,
     $Total,
     $pic,
     $note,
     $nespa=100;
     public function updated($propertyName)
    {
        $this->validateOnly($propertyName,[
            "invoice_number"=>"required",
        ]);
    }
    public function render()
    {
        return view('livewire.add-invoive',[
            'sections'=>sections::all(),
        ]);
    }
    public function firstStepSubmit(){
        $this->currentStep=2;
    }
    function myFunction() {
        //  $Amount_Commission = parseFloat(document.getElementById("Amount_Commission").value);
        //  $Discount = parseFloat(document.getElementById("Discount").value);
        //  $Rate_VAT = parseFloat(document.getElementById("Rate_VAT").value);
        //  $Value_VAT = parseFloat(document.getElementById("Value_VAT").value);
         $Amount_Commission2 = floatval($this->Amount_Commission) - floatval($this->Discount);
         
            $intResults = $Amount_Commission2 * floatval($this->Rate_VAT) / $this->nespa;
            $intResults2 = floatval( $intResults +$Amount_Commission2);
            $sumq = floatval($intResults);
            $sumt = floatval($intResults2);
            $this->Value_VAT = $sumq;
           $this->Total = $sumt;
        
    }
    public function back($step){

        $this->currentStep=$step;
    }
    public function secondStepSubmit(){
        $this->currentStep=3;
    }
    public function threeStepSubmit(){
        $this->currentStep=4;
    }
    public function getProducts($id){
        $products=products::where("section_id",$id)->pluck("Product_name","id");
        
         return $pro=json_encode($products);
        echo "<option value=".$pro.">$pro</option>";
       
    }
    public function submitForm(Request $request){
        dd($request);
    }
}
