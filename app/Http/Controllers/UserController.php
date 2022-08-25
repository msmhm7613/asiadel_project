<?php

namespace App\Http\Controllers;

use App\Role;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function form(){

        $roles = Role::all();
        if(is_null($roles))
            return redirect()->route('admin.roles');
        return view('admin.create_user',compact('roles'));

    }

    public function create(Request $req){

        // validate request

        $validator = Validator::make($req->all(), [
            'fullname' => 'required|max:100',
            'email' => 'unique:users|email|required',
            'password' => 'required|min:6',
            'same_password' => 'required|same:password',
            'cellphone' => 'required|min:11|max:11',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with(['status' => 2,'msg' => 'خطاهای زیر رخ داده اند : '])->withErrors($validator)->withInput();
        }

        if(isset($req->role_id))
            $role_id = $req->role_id;
        else
            $role_id = 2;

        try{

            $user = User::create([
                'fullname' => $req->fullname,
                'email' => $req->email,
                'password' => bcrypt($req->password),
                'cellphone' => $req->cellphone,
                'role_id' => $role_id,
                'remember_token' => Str::random(100)
            ]);

            // if user register auto login
            if(!isset($req->role_id))
                Auth::loginUsingId($user->id);

            return redirect()->back()->with(['status' => 1,'msg' => $this->success_msg]);

        } catch(Exception $exp){
            return redirect()->back()->withInput()->with(['status' => 0,'msg' => $exp->getMessage()]);
        }


    }

    public function users()
    {
        $users = User::AllUser()->paginate(10);
        if($users){
            foreach($users as $user){
                $role = Role::findOrFail($user->role_id, ['title']);
                $user->role_title = $role->title;
            }
        }

        return view('admin.users',compact('users'));
    }

    public function remove($id){

        $user = User::findOrFail($id);
        $user->is_active = 0;

        if($user->save())
            return redirect()->back()->with(['status' => 1,'msg' => $this->success_msg]);
        else
            return redirect()->back()->with(['status' => 0,'msg' => $this->fail_msg]);

    }

    public function login(Request $req){

         // validate request

         $validator = Validator::make($req->all(), [
            'mobile' => 'required|min:11|max:11',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with(['status' => 2,'msg' => 'خطاهای زیر رخ داده اند : '])->withErrors($validator)->withInput();
        }

        if (Auth::attempt(['cellphone' => $req->mobile, 'password' => $req->password, 'is_active' => 1])) {

            return redirect('/');

        } else {
            return redirect('login')->with(['status' => 0, 'msg' => 'کاربری با این مشخصات پیدا نشد']);
        }

    }

    public function logout(){
        if(Auth::check()){
            Auth::logout();
            return redirect('/');
        } else {
            return abort(404);
        }
    }
}
