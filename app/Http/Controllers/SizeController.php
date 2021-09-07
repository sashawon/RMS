<?php

namespace App\Http\Controllers;

use App\Models\Counter\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['data'] = Size::all();
        return view('/counter/size',$result);
    }

    public function status(Request $request, $status, $id)
    {
        $model = Size::find($id);
        $model->status = $status;
        $model->save();
        session()->flash('msg','Size Status Update Successfully');
        return redirect('/counter/size');
    }

    public function manage_size(Request $request, $id='')
    {
        if ($id>0) {
            $arr = Size::where(['id'=>$id])->get();

            $result['id'] = $arr['0']->id;
            $result['size_name'] = $arr['0']->size_name;
            
            $result['size']=DB::table('sizes')->where(['status'=>1])->where('id','!=',$id)->get();
        } else {
            $result['id'] = 0;
            $result['size_name'] = '';
            
            $result['size']=DB::table('sizes')->where(['status'=>1])->get();
        }
        
        return view('/counter/manage_size',$result);
    }

    public function manage_size_process(Request $request)
    {
        $request->validate([
            'size_name'=>'required'
        ]);

        if ($request->post('id')>0) {
            $model = Size::find($request->post('id'));
            $msg = 'Size Update Successfully';
        } else {
            $model = new Size();
            $msg = 'Size Add Successfully';
        }

                
        $model->size_name = $request->post('size_name');
        $model->status = 1;
        $model->save();
        session()->flash('msg',$msg);
        return redirect('/counter/size');

    }
    
    public function destroy(Request $request, $id)
    {
        $model = Size::find($id);
        $model->delete();
        session()->flash('msg','Size Delete Successfully');
        return redirect('/counter/size');
    }
}
