<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['buyer_id','seller_id','pro_id','offer_id','price','cellphone','address'];
    public function get_buyer(){
        return $this->hasOne('App\User','id','buyer_id');
    }
}
