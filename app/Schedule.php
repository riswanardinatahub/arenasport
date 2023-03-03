<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $guuarded = [];
    
    public function product(){
         return $this->belongsTo(Product::class, 'products_id','id')->withTrashed();
     }
}
