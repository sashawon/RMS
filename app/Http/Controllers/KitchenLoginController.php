<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kitchen\KitchenLogin;
use Illuminate\Http\Request;

class KitchenLoginController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has('KITCHEN_LOGIN')) {
            return redirect('/kitchen/dashboard');
        } else {
            return view('kitchen/login');
        }
        return view('/kitchen/login');
    }

    public function auth(Request $request)
    {
        $username = $request->post('username');
        $password = $request->post('password');

        //$result = KitchenLogin::where(['username'=>$username,'password'=>$password])->get();
        $result = KitchenLogin::where(['username'=>$username])->first();

        if ($result) {
            if ($password==$result->password) {
                $request->session()->put('KITCHEN_LOGIN',true);
                $request->session()->put('KITCHEN_ID',$result->id);
                return redirect('/kitchen/dashboard');
            } else {
                $request->session()->flash('msg','Please enter Correct password');
                return redirect('kitchen');
            }            
        } else {
            $request->session()->flash('msg','Please enter valid login details');
            return redirect('kitchen');
        }
    }

    public function dashboard(Request $request)
    {
        return view('kitchen/dashboard');
    }

    /*public function updatepassword()
    {
        $r=KitchenLogin::find(1);
        $r->password=Hash::make('1234');
        $r->save();
    }*/
}
