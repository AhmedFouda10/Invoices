<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class invoices extends Model
{
    use HasTranslations;
    public $translatable = ['note','product'];
    use HasFactory;
    use SoftDeletes;
    protected $dates=['deleted_at'];

    public function section(){
        return $this->belongsTo(sections::class,'section_id','id');
    }
    public function product(){
        return $this->belongsTo(products::class,'product_id','id');
    }
}
