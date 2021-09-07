<?php

namespace App\Http\Controllers;

use App\Models\Counter\TotalTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TotalTableController extends Controller
{
    public function index()
    {
        $result['data'] = TotalTable::all();
        return view('/counter/table',$result);
    }

    public function status(Request $request, $status, $id)
    {
        $model = TotalTable::find($id);
        $model->status = $status;
        $model->save();
        session()->flash('msg','Table Status Update Successfully');
        return redirect('/counter/table');
    }

    public function manage_table(Request $request, $id='')
    {
        if ($id>0) {
            $arr = TotalTable::where(['id'=>$id])->get();

            $result['id'] = $arr['0']->id;
            $result['table_no'] = $arr['0']->table_no;
            $result['table_users'] = $arr['0']->table_users;
            $result['password'] = $arr['0']->password;
            $result['table']=DB::table('total_tables')->where(['status'=>1])->where('id','!=',$id)->get();
        } else {
            $result['id'] = 0;
            $result['table_no'] = '';
            $result['table_users'] = '';
            $result['password'] = '';
            $result['table']=DB::table('total_tables')->where(['status'=>1])->get();
        }
        
        return view('/counter/manage_table',$result);
    }

    public function manage_table_process(Request $request)
    {

        if ($request->post('id')>0) {
            $model = TotalTable::find($request->post('id'));
            $msg = 'Table Update Successfully';
        } else {
            $request->validate([
                'table_no'=>'required|unique:total_tables,table_no'
            ]);
            
            $model = new TotalTable();
            $msg = 'Table Add Successfully';
        }

                
        $model->table_no = $request->post('table_no');
        $model->table_users = $request->post('table_users');
        $model->password = $request->post('password');
        $model->status = 1;
        $model->save();
        session()->flash('msg',$msg);
        return redirect('/counter/table');

    }
    
    public function destroy(Request $request, $id)
    {
        $model = TotalTable::find($id);
        $model->delete();
        session()->flash('msg','Table Delete Successfully');
        return redirect('/counter/table');
    }
}
