<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class invoices_details extends Model
{
    use HasTranslations;
    public $translatable = ['note'];
    use HasFactory;
    public function section(){
        return $this->belongsTo(sections::class,'Section','id');
    }
    public function product(){
        return $this->belongsTo(products::class,'product_id','id');
    }
}
