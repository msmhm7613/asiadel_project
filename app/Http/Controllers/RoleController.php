<?php

namespace App\Http\Controllers;

use App\Accessibility;
use App\Role;
use Exception;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function roles(){
        $roles = Role::all();
        if($roles){
            foreach($roles as $role){
                $role->access = json_decode($role->access_id);
            }
        }
        return view('admin.roles',compact('roles'));

    }

    public function store(Request $req){

        // validate reuqest
        $req->validate([
            'title' => 'required|string',
        ],[
            'title.required' => 'عنوان نقش را مشخص کنید',
        ]);

        // check unique title
        $role = Role::where('title',$req->title)->first();
        if($role)
            return redirect()->back()->with(['status' => 0,'msg' => 'عنوان نقش قبلا در سیستم ثبت شده است']);

        if(!isset($req->access))
            return redirect()->back()->with(['status' => 0,'msg' => 'حداقل یک بخش را برای دسترسی مشخص کنید']);

        // create access json
        $c = count($req->access);
        $acc_array = array(['access_id' => 7,'access_title' => 'داشبورد', 'access_route' => ['admin.dashboard']]);

        $test = array([1 => ['admin.products','admin.delete.product'],
            2 => ['admin.create.product','admin.form.product'],
            3 => [''],
            4 => [''],
            5 => ['admin.users','admin.delete.user'],
            6 => ['admin.form.user','admin.create.user']]);

        for($i = 0;$i < $c;$i++){

            $access = Accessibility::findOrFail($req->access[$i]);
            $acc_array[] = [
                'access_id' => $req->access[$i],
                'access_title' => $access->title,
                'access_route' => $test[0][$req->access[$i]]
            ];

        }
        $access_id = json_encode($acc_array);

        try{

            $role = new Role();
            $role->title = $req->title;
            $role->access_id = $access_id;
            $role->save();

            return redirect()->back()->with(['status' => 1,'msg' => $this->success_msg]);

        } catch(Exception $exp){
            return redirect()->back()->with(['status' => 0,'msg' => $this->fail_msg]);
        }

    }
}
