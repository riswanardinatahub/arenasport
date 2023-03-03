<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedules';
    protected $fillable = ['status','time','products_id'];
    
    public function product(){
         return $this->belongsTo(Product::class, 'products_id','id')->withTrashed();
     }
}
