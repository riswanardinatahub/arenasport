<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'users_id', 
        'arena_id', 
        'inscurance_price', 
        'shipping_price',
        'total_price',
        'down_payment',
        'transaction_status',
        'status_transaction_customer',
        'code',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
       
    ];


     public function user(){
         return $this->belongsTo(User::class, 'users_id','id');
     }
     public function arena(){
         return $this->belongsTo(User::class, 'arena_id','id');
     }
}
