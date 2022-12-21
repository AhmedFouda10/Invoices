<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasTranslations;

    public $translatable = ['Product_name','description'];
    use HasFactory;

    public function section(){
        return $this->belongsTo(sections::class,'section_id','id');
    }
}

