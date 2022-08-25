<?php

namespace App\Http\Controllers;

use App\Offer;
use App\Product;
use App\User;
use Exception;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class OfferController extends Controller
{
    public function check_date($pro_id){
        $product = Product::find($pro_id);
        $now = Verta::now();
        $from_date = ($now > $product->from_date);
        $to_date = ($now < $product->to_date);
        return array([
            'now' => $now,
            'from_date' => $from_date,
            'to_date' => $to_date,
        ]);
    }

    public function create(Request $req){

        // validate request

        $validator = Validator::make($req->all(), [
            'price' => 'required|max:20',
            'pro_id' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with(['status' => 2,'msg' => 'خطاهای زیر رخ داده اند : '])->withErrors($validator)->withInput();
        }

        $product = Product::findOrFail($req->pro_id);

        // check_date
        $check_result = $this->check_date($req->pro_id);

        if($check_result[0]['to_date'] === false || $check_result[0]['from_date'] === false)
            return redirect()->back()->with(['status' => 0,'msg' => $this->fail_msg]);

        // check offer number
        if(Auth::user()->offer == 0)
            return redirect()->back()->with(['status' => 0,'msg' => 'تعداد پیشنهاد های شما به اتمام رسیده است']);

        try{

            $u_id = Auth::id();
            // check exist offer

            $exist_offer = Offer::where('pro_id',$req->pro_id)->where('user_id',$u_id)->exists();
            if($exist_offer)
                return redirect()->back()->with(['status' => 0,'msg' => 'شما قبلا برای این آگهی پیشنهاد خود را ثبت کرده اید']);

            // create offer
            $offer = new Offer();
            $offer->user_id = $u_id;
            $offer->pro_id = $req->pro_id;
            $offer->price = $req->price;
            $offer->save();

            // decrement user offer
            $current_user = User::find($u_id);
            $current_user->decrement('offer');

            return redirect()->back()->with(['status' => 1,'msg' => $this->success_msg]);
        } catch(Exception $exp){
            return redirect()->back()->with(['status' => 0,'msg' => $this->fail_msg]);
        }
    }

    public function select_offer($slug,$offer_id){

        $pro = Product::where('slug',$slug)->first();
        $offer = Offer::findOrFail($offer_id);

        if(is_null($pro))
            return redirect()->back()->with(['status' => 0,'msg' => 'آگهی پیدا نشد']);

        // calculate Time For Checkout
        $pay_date = $pro->pay_date;
        $pay_date = Verta("+$pay_date minutes");

        try{

            $offer->status = 1;
            $offer->pay_date = $pay_date;
            $offer->save();

            // check pro status if != 0
            $pro->status = 1;
            $pro->save();

            return redirect()->back()->with(['status' => 1,'msg' => "پیشنهاد کاربر تائید ، مهلت پرداخت کاربر تا : $pay_date می باشد !"]);

        } catch(Exception $exp){
            return redirect()->back()->with(['status' => 0,'msg' => $this->fail_msg]);
        }

    }

    public function my_offer()
    {
        $offers = User::find(Auth::id())->my_offers()->latest()->get();

        if(count($offers)){

            foreach($offers as $item){
                $product = Product::find($item->pro_id);
                $item->pro_title = $product->title;
                $item->pro_price = $product->price;
                $item->pro_slug = $product->slug;
            }

        }

        return view('my_offers',compact('offers'));

    }
}
