<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['title','slug','price','image','body','attrs','created_id','from_date','to_date','pay_date'];

    public function scopeActive($query){
        $query->where('is_delete',0)->latest();
    }
    public function scopeCreateStatus($query){
        $query->where('is_delete',0)->where('status',0)->latest();
    }
    public function offers(){
        return $this->hasMany('App\Offer', 'pro_id');
    }
}
