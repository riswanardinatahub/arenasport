<?php

namespace App;

use App\Models\District;
use App\Models\Regency;
use App\Models\Village;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

     use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','roles','store_name','images','arena_photos','maps','categories_id','store_status',
        'address_one', 'address_two', 'provinces_id','regencies_id','districts_id','villages_id','zip_code','country','phone_number',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function villages()
    {
        return $this->belongsTo(Village::class, 'villages_id','id');
    }

     public function regencies()
    {
        return $this->belongsTo(Regency::class, 'regencies_id','id')->withDefault(['name' => '']);
    }

    public function districts()
    {
        return $this->belongsTo(District::class, 'districts_id','id');
    }

    public function category(){
         return $this->belongsTo(Category::class, 'categories_id','id');
     }


}
