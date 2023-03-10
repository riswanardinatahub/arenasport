<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'transactions_id', 
        'products_id', 
        'price',
        'book_date',
        'book_time',
        'shipping_status',
        'resi',
        'code',
        'total_qty'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
       
    ];

    public function product(){
         return $this->hasOne(Product::class, 'id','products_id');
     }

      public function transaction(){
         return $this->hasOne(Transaction::class, 'id','transactions_id');
     }
}
