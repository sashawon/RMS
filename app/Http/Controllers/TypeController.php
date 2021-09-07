<?php

namespace App\Http\Controllers;

use App\Models\Counter\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['data'] = Type::all();
        return view('/counter/type',$result);
    }

    public function status(Request $request, $status, $id)
    {
        $model = Type::find($id);
        $model->status = $status;
        $model->save();
        session()->flash('msg','Type Status Update Successfully');
        return redirect('/counter/type');
    }

    public function manage_type(Request $request, $id='')
    {
        if ($id>0) {
            $arr = Type::where(['id'=>$id])->get();

            $result['id'] = $arr['0']->id;
            $result['type_name'] = $arr['0']->type_name;
            $result['is_home'] = $arr['0']->is_home;
            $result['is_home_selected'] = "";
            if ($arr['0']->is_home==1) {
                $result['is_home_selected'] = "checked";
            }
            $result['type']=DB::table('types')->where(['status'=>1])->where('id','!=',$id)->get();
        } else {
            $result['id'] = 0;
            $result['type_name'] = '';
            $result['is_home'] = '';
            $result['is_home_selected'] = '';
            $result['type']=DB::table('types')->where(['status'=>1])->get();
        }
        
        return view('/counter/manage_type',$result);
    }

    public function manage_type_process(Request $request)
    {
        $request->validate([
            'type_name'=>'required'
        ]);

        if ($request->post('id')>0) {
            $model = Type::find($request->post('id'));
            $msg = 'Type Update Successfully';
        } else {
            $model = new Type();
            $msg = 'Type Add Successfully';
        }

                
        $model->type_name = $request->post('type_name');
        $model->is_home = 0;
        if ($request->post('is_home')!==null) {
            $model->is_home = 1;
        }
        $model->status = 1;
        $model->save();
        session()->flash('msg',$msg);
        return redirect('/counter/type');

    }
    
    public function destroy(Request $request, $id)
    {
        $model = Type::find($id);
        $model->delete();
        session()->flash('msg','Type Delete Successfully');
        return redirect('/counter/type');
    }
}
