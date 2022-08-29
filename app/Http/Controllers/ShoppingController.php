<?php

namespace App\Http\Controllers;

use App\Offer;
use App\Order;
use App\Product;
use App\UserOfferPkg;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isNull;

class ShoppingController extends Controller
{
    public function create(Request $req)
    {

        if($req->isMethod('GET')){

            // get cart price

        }

        // validate request

        $validator = Validator::make($req->all(), [
            'price' => 'required|max:20',
            'pro_id' => 'required',
            'offer_id' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with(['status' => 2, 'msg' => 'خطاهای زیر رخ داده اند : '])->withErrors($validator)->withInput();
        }

        $offer = Offer::where('id', $req->offer_id)
            ->where('user_id', Auth::id())
            ->where('status', 1)
            ->first();

        $product = Product::where('id', $req->pro_id)
            ->where('status', 1)
            ->where('is_delete', 0)
            ->first();


        if (is_null($offer) || is_null($product))
            return redirect()->back()->with(['status' => 0, 'msg' => 'خطا در شناسایی ،رکورد پیدا نشد !']);

        // check time for pay
        if ($offer->pay_date < Verta::now())
            return redirect()->back()->with(['status' => 0, 'msg' => 'مهلت زمانی پرداخت تمام شده است']);

        try {

            $order = Order::where('buyer_id', Auth::id())
                ->where('pro_id', $req->pro_id)
                ->where('offer_id', $req->offer_id)
                ->where('price', $offer->price)
                ->first();

            if (is_null($order)) {
                $order = Order::create([
                    'buyer_id' => Auth::id(),
                    'seller_id' => $product->created_id,
                    'pro_id' => $req->pro_id,
                    'offer_id' => $req->offer_id,
                    'price' => $offer->price,
                    'cellphone' => $req->cellphone,
                    'address' => $req->address
                ]);
            }

            return view('bank', compact('offer', 'order'));

        } catch (Exception $exp) {
            return redirect()->back()->with(['status' => 0, 'msg' => $this->fail_msg]);
        }
    }

    public function checkout($ref_code, $status, $offer_id, $order_id)
    {

        $order = Order::findOrFail($order_id);
        $offer = Offer::findOrFail($offer_id);
        $product = Product::where('id', $order->pro_id)->first();
        try {

            $order->pay_status = $status;


            if ($status == 1) {
                $order->status = 1;
                $offer->status = 3;
                $product->status = 2;
                $offer->save();
            }

            $order->save();
            $product->save();
            if ($status == 1)
                return redirect('my_offers')->with(['status' => 1, 'msg' => 'عملیات پرداخت و ثبت سفارش با موفقیت انجام شد !']);
            elseif ($status == 2)
                return redirect('my_offers')->with(['status' => 0, 'msg' => 'خطا در عملیات پرداخت ، مجددا تلاش نمایید']);
            else
                return redirect('my_offers')->with(['status' => 0, 'msg' => 'خطا در ثبت سفارش']);

        } catch (Exception $exp) {
            return redirect()->back()->with(['status' => 0, 'msg' => $this->fail_msg]);
        }

    }

    public function send_product($order_id)
    {
        $order = Order::where('id', $order_id)->where('seller_id', Auth::id())->first();
        $product = Product::findOrFail($order->pro_id);

        try {
            $order->status = 2;
            $product->status = 3;

            $order->save();
            $product->save();

            return redirect()->back()->with(['status' => 1, 'msg' => $this->success_msg]);

        } catch (Exception $exp) {
            return redirect()->back()->with(['status' => 0, 'msg' => $exp->getMessage()]);
        }
    }

    public function cart()
    {
        if(!Auth::check())
            return redirect('login');

        $cart = DB::table('offer_packages')
            ->join('user_offer_pkg', 'offer_packages.id', '=', 'user_offer_pkg.pkg_id')
            ->select('offer_packages.*')
            ->where('user_offer_pkg.user_id','=',Auth::id())
            ->where('user_offer_pkg.pay_status','=',0)
            ->first();

        return view('cart',compact('cart'));

    }
}
