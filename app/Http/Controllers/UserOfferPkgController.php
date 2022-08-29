<?php

namespace App\Http\Controllers;

use App\OfferPackage;
use App\UserOfferPkg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserOfferPkgController extends Controller
{
    public function create($pkg_id){

        $offer_pkg = OfferPackage::findOrFail($pkg_id);

        $user_coupon = UserOfferPkg::where('user_id',Auth::id())
            ->where('pkg_id',$pkg_id)
            ->where('pay_status',0)
            ->first();

        if(is_null($user_coupon)){

            // Create Coupon For User
            try{

                $new_coupon = new UserOfferPkg();
                $new_coupon->pkg_id = $pkg_id;
                $new_coupon->user_id = Auth::id();
                $new_coupon->save();

            } catch (\Exception $exp) {
                return redirect()->back()->with(['status' => 0,'msg' => $this->fail_msg]);
            }

        }
        return redirect('cart');
    }
}
