<?php

namespace App\Http\Controllers;

use App\Models\Waiter\WaiterLogin;
use Illuminate\Http\Request;
use App\Models\Counter\TotalWaiter;

class WaiterLoginController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has('WAITER_LOGIN')) {
            return redirect('/waiter/dashboard');
        } else {
            return view('/waiter/login');
        }
        return view('/waiter/login');
    }

    public function auth(Request $request)
    {
        echo $username = $request->post('username');
        echo $password = $request->post('password');


        //$result = TotalTable::where(['username'=>$username,'password'=>$password])->get();
        $result = TotalWaiter::where(['username'=>$username])->first();
        // echo "<pre>";
        // print_r($result);
        // die();

        if ($result) {
            if ($password==$result->password) {
                $request->session()->put('WAITER_LOGIN',true);
                $request->session()->put('WAITER_ID',$result->id);
                $request->session()->put('TABLE_ID',$result->table_id);
                return redirect('/waiter/dashboard');
            } else {
                $request->session()->flash('msg','Please enter Correct password');
                return redirect('/waiter/');
            }            
        } else {
            $request->session()->flash('msg','Please enter valid login details');
            return redirect('/waiter/');
        }
    }

    public function dashboard(Request $request)
    {
        return view('/waiter/dashboard');
    }
}
