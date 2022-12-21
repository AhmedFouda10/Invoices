<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class sections extends Model
{
    use HasTranslations;

    public $translatable = ['section_name','description'];
    // protected $fillable=[
    //     "section_name",
    //     "description",
    //     "Created_by",
    // ];
    use HasFactory;
}
