<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Counter\CounterLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CounterLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->session()->has('COUNTER_LOGIN')) {
            return redirect('/counter/dashboard');
        } else {
            return view('counter/login');
        }
        return view('counter/login');
    }

    public function auth(Request $request)
    {
        $username = $request->post('username');
        $password = $request->post('password');

        //$result = CounterLogin::where(['username'=>$username,'password'=>$password])->get();
        $result = CounterLogin::where(['username'=>$username])->first();

        if ($result) {
            if (Hash::check($password,$result->password)) {
                $request->session()->put('COUNTER_LOGIN',true);
                $request->session()->put('COUNTER_ID',$result->id);
                return redirect('/counter/dashboard');
            } else {
                $request->session()->flash('msg','Please Enter Correct Password');
                return redirect('counter');
            }            
        } else {
            $request->session()->flash('msg','Please Enter Valid Login Details');
            return redirect('counter');
        }
    }

    public function dashboard(Request $request)
    {
        return view('counter/dashboard');
    }

    /*public function updatepassword()
    {
        $r=CounterLogin::find(1);
        $r->password=Hash::make('1234');
        $r->save();
    }*/
}
