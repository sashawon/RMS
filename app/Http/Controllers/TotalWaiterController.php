<?php

namespace App\Http\Controllers;

use App\Models\Counter\TotalWaiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TotalWaiterController extends Controller
{
    public function index()
    {
        $result['data'] = TotalWaiter::leftjoin('total_tables','total_waiters.table_id','total_tables.id')->select('total_waiters.id', 'total_waiters.name', 'total_waiters.table_id', 'total_waiters.username', 'total_waiters.password', 'total_waiters.status', 'total_tables.table_no')->get();

        // echo "<pre>";
        // print_r($result);
        // die();

        return view('/counter/waiter',$result);
    }

    public function status(Request $request, $status, $id)
    {
        $model = TotalWaiter::find($id);
        $model->status = $status;
        $model->save();
        session()->flash('msg','Waiter Status Update Successfully');
        return redirect('/counter/waiter');
    }

    public function manage_waiter(Request $request, $id='')
    {
        if ($id>0) {
            $arr = TotalWaiter::where(['id'=>$id])->get();
            
            // echo "<pre>";
            // print_r($arr);
            // die();

            $result['id'] = $arr['0']->id;
            $result['name'] = $arr['0']->name;
            $result['table_id'] = $arr['0']->table_no;
            $result['username'] = $arr['0']->username;
            $result['password'] = $arr['0']->password;
            $result['waiter']=DB::table('total_waiters')->where(['status'=>1])->where('id','!=',$id)->get();
        } else {
            $result['id'] = 0;
            $result['name'] = '';
            $result['table_id'] = '';
            $result['username'] = '';
            $result['password'] = '';
            $result['waiter']=DB::table('total_waiters')->where(['status'=>1])->get();
        }

        $result['table']=DB::table('total_tables')->where(['status'=>1])->get();
        
        return view('/counter/manage_waiter',$result);
    }

    public function manage_waiter_process(Request $request)
    {
        if ($request->post('id')>0) {
            $model = TotalWaiter::find($request->post('id'));
            $msg = 'Waiter Update Successfully';
        } else {
            $request->validate([
                'table_no'=>'required|unique:total_waiters,id'
            ]);

            $model = new TotalWaiter();
            $msg = 'Waiter Add Successfully';
        }

                
        $model->name = $request->post('name');
        $model->table_id = $request->post('table_no');
        $model->username = $request->post('username');
        $model->password = $request->post('password');
        $model->status = 1;
        $model->save();
        session()->flash('msg',$msg);
        return redirect('/counter/waiter');

    }
    
    public function destroy(Request $request, $id)
    {
        $model = TotalWaiter::find($id);
        $model->delete();
        session()->flash('msg','Waiter Delete Successfully');
        return redirect('/counter/waiter');
    }
}
