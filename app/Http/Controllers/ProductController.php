<?php

namespace App\Http\Controllers;

use App\Offer;
use App\Order;
use App\Product;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function create(Request $req){

        // validate request

        $validator = Validator::make($req->all(), [
            'title' => 'required|unique:products|max:100',
            'body' => 'nullable',
            'price' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
            'pay_date' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,gif,png'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with(['status' => 2,'msg' => 'خطاهای زیر رخ داده اند : '])->withErrors($validator)->withInput();
        }

        // upload image
        if($req->image){

            $file_obj = new FileController();
            $result = $file_obj->upload($req->image,'images/products');
            if ($result === false) {
                return redirect()->back()->withInput()->with(['status' => 0,'msg' => 'خطا در بارگذاری فایل']);
            } else {
                $image = $result;
            }

        } else {
            $image = 'default.png';
        }

        // merge attributes
        $c = count($req->key);
        $attr_array = array();
        for($i = 0;$i < $c;$i++){
            $attr_array[] = [
                'key' => $req->key[$i],
                'value' => $req->value[$i]
            ];
        }

        $attrs = json_encode($attr_array);

        // Auth::loginUsingId(1);

        try{

            Product::create([
                'title' => $req->title,
                'slug' => Str::slug($req->title),
                'image' => $image,
                'body' => $req->body,
                'price' => $req->price,
                'attrs' => $attrs,
                'created_id' => Auth::id(),
                'from_date' => $req->from_date,
                'to_date' => $req->to_date,
                'pay_date' => $req->pay_date
            ]);

            return redirect()->back()->with(['status' => 1,'msg' => $this->success_msg]);
        } catch(Exception $exp) {
            // return redirect()->back()->withInput()->with(['status' => 0,'msg' => $exp->getMessage()]);
            return redirect()->back()->with(['status' => 0,'msg' => $this->fail_msg]);
        }

    }

    public function all(){

        $products = Product::active()->paginate(10);
        if($products){
            foreach($products as $item){

            }
        }
        return view('admin.products',compact('products'));

    }

    public function remove($id){

        $product = Product::findOrFail($id);
        $product->is_delete = 1;
        if($product->save())
            return redirect()->back()->with(['status' => 1,'msg' => $this->success_msg]);
        else
            return redirect()->back()->with(['status' => 0,'msg' => $this->fail_msg]);

    }

    public function show($slug)
    {
        $product = Product::active()->where('slug',$slug)->first();

        // check date for offer
        $obj_check = new OfferController();
        $result_check = $obj_check->check_date($product->id);

        // end check

        $attrs = json_decode($product->attrs);
        $offers = Product::find($product->id)->offers()->orderBy('price','DESC')->get();
        if(count($offers)){
            foreach($offers as $item){
                $user_offer = User::findOrFail($item->user_id);
                $item->offer_fullname = $user_offer->fullname;

            }
        }

        return view('product',compact('product','offers','attrs','result_check'));
    }

    public function user_products(){

        $u_id = Auth::id();
        $products = Product::active()->where('created_id',$u_id)->latest()->get();

        if(count($products)){
            foreach($products as $item){
                $item->offers = Offer::where('pro_id',$item->id)->latest()->get();
                $order = Order::where('pro_id',$item->id)->first();
                if($order) {
                    $item->buyer_info = Order::find($order->id)->get_buyer;
                    $item->order_info = $order;
                    $item->order_id = $order->id;
                }
            }
        }
        return view('my_products',compact('products'));

    }
}
