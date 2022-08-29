<?php

namespace App\Http\Controllers;

use App\OfferPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OfferPackageController extends Controller
{
    public function create(Request $req){
        // validate request

        $validator = Validator::make($req->all(), [
            'price' => 'required|max:20',
            'title' => 'required|unique:offer_packages',
            'qui' => 'required|max:3',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with(['status' => 2,'msg' => 'خطاهای زیر رخ داده اند : '])->withErrors($validator)->withInput();
        }

        try{

            OfferPackage::create([
                'title' => $req->title,
                'body' => $req->body,
                'price' => $req->price,
                'qui' => $req->qui,
            ]);

            return redirect()->back()->with(['status' => 1,'msg' => $this->success_msg]);

        } catch (\Exception $exp) {
            return redirect()->back()->with(['status' => 0,'msg' => $this->fail_msg]);
        }

    }

    public function all(Request $request){

        $packages = OfferPackage::latest()->get();
        if($request->route()->getName() == 'user.offer_package')
            return view('packages',compact('packages'));
        else
            return view('admin.packages',compact('packages'));

    }

}
