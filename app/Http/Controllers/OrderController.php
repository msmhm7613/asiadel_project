<?php

namespace App\Http\Controllers;

use App\Offer;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function form($offer_id){
        $offer = Offer::where('id',$offer_id)->where('user_id',Auth::id())->first();
        if(is_null($offer))
            return redirect()->back()->with(['status' => 0,'msg' => 'پیشنهاد ، پیدا نشد !']);

        $product = Product::Active()->findOrFail($offer->pro_id);
        return view('create_order',compact('offer','product'));
    }
}
