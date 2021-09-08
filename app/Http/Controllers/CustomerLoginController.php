<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer\CustomerLogin;
use Illuminate\Http\Request;
use App\Models\Counter\TotalTable;

class CustomerLoginController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has('CUSTOMER_LOGIN')) {
            return redirect('/dashboard');
        } else {
            return view('/login');
        }
        return view('/login');
    }

    public function auth(Request $request)
    {
        $username = $request->post('username');
        $password = $request->post('password');


        //$result = TotalTable::where(['username'=>$username,'password'=>$password])->get();
        $result = TotalTable::where(['table_users'=>$username])->first();
        // echo "<pre>";
        // print_r($result);
        // die();

        if ($result) {
            if ($password==$result->password) {
                $request->session()->put('CUSTOMER_LOGIN',true);
                $request->session()->put('TABLE_ID',$result->id);
                $request->session()->put('TABLE_NO',$result->table_no);
                return redirect('/dashboard');
            } else {
                $request->session()->flash('msg','Please enter Correct password');
                return redirect('/');
            }            
        } else {
            $request->session()->flash('msg','Please enter valid login details');
            return redirect('/');
        }
    }

    public function dashboard(Request $request)
    {
        return view('/dashboard');
    }    
}
