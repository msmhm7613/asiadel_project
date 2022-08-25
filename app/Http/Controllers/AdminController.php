<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function login(Request $req)
    {

        // validate request

        $validator = Validator::make($req->all(), [
            'cellphone' => 'required|min:11|max:11',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with(['status' => 2, 'msg' => 'خطاهای زیر رخ داده اند : '])->withErrors($validator)->withInput();
        }

        if (Auth::attempt(['cellphone' => $req->cellphone, 'password' => $req->password, 'is_active' => 1])) {

            $role_id = Auth::user()->role_id;

            // if Normal User !
            if ($role_id == 2)
                return redirect('/');

            //** Get User Access  */
            $role = Role::findOrFail($role_id);
            $access = json_decode($role->access_id);

            if (session()->exists('access_route')) {
                session()->forget('access_route');
                session()->forget('access_id');
            }

            foreach ($access as $item) {
                session()->push('access_id', $item->access_id);
                foreach ($item->access_route as $acc_item) {
                    session()->push('access_route', [$acc_item]);
                }
            }

            return redirect('admin/dashboard');
        } else {
            return redirect('admin/login')->with(['status' => 0, 'msg' => 'کاربری با این مشخصات پیدا نشد']);
        }

    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
