<?php

namespace App\Http\Controllers;

use App\Models\Counter\Vat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['data'] = Vat::all();
        return view('/counter/vat',$result);
    }
    
    public function status(Request $request, $status, $id)
    {
        $model = Vat::find($id);
        $model->status = $status;
        $model->save();
        session()->flash('msg','Vat Status Update Successfully');
        return redirect('/counter/vat');
    }

    public function manage_vat(Request $request, $id='')
    {
        if ($id>0) {
            $arr = Vat::where(['id'=>$id])->get();

            $result['id'] = $arr['0']->id;
            $result['vat_desc'] = $arr['0']->vat_desc;
            $result['vat_value'] = $arr['0']->vat_value;
            $result['status'] = $arr['0']->status;
        } else {
            $result['id'] = 0;
            $result['vat_desc'] = '';
            $result['vat_value'] = '';
            $result['status'] = '';
        }
        
        return view('/counter/manage_vat',$result);
    }
    
    public function manage_vat_process(Request $request)
    {
        //return $request->post(); 
        //echo "<pre>";
        //print_r($request->post());
        //die();

        $request->validate([
            'vat_value'=>'required|unique:vats,vat_value,'.$request->post('id')
        ]);

        if ($request->post('id')>0) {
            $model = Vat::find($request->post('id'));
            $msg = 'Vat Update Successfully';
        } else {
            $model = new Vat();
            $msg = 'Vat Add Successfully';
        }
        
        $model->vat_desc = $request->post('vat_desc');
        $model->vat_value = $request->post('vat_value');
        $model->status = 1;
        $model->save();
        session()->flash('msg',$msg);
        return redirect('/counter/vat');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Counter\Vat  $vat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $model = Vat::find($id);
        $model->delete();
        session()->flash('msg','Vat Delete Successfully');
        return redirect('/counter/vat');
    }
}
