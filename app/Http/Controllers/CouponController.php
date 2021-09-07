<?php

namespace App\Http\Controllers;

use App\Models\Counter\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $result['data'] = Coupon::all();
        return view('/counter/coupon',$result);
    }

    public function status(Request $request, $status, $id)
    {
        $model = Coupon::find($id);
        $model->status = $status;
        $model->save();
        session()->flash('msg','Coupon Status Update Successfully');
        return redirect('/counter/coupon');
    }

    public function manage_coupon(Request $request, $id='')
    {
        if ($id>0) {
            $arr = Coupon::where(['id'=>$id])->get();

            $result['id'] = $arr['0']->id;
            $result['title'] = $arr['0']->title;
            $result['code'] = $arr['0']->code;
            $result['value'] = $arr['0']->value;
            $result['type'] = $arr['0']->type;
            $result['min_ord_amt'] = $arr['0']->min_ord_amt;
            $result['is_one_time'] = $arr['0']->is_one_time;
        } else {
            $result['id'] = 0;
            $result['title'] = '';
            $result['code'] = '';
            $result['value'] = '';
            $result['type'] = '';
            $result['min_ord_amt'] = '';
            $result['is_one_time'] = '';
        }
        
        return view('/counter/manage_coupon',$result);
    }

    public function manage_coupon_process(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'code'=>'required|unique:coupons,code,'.$request->post('id'),
            'value'=>'required'
        ]);

        if ($request->post('id')>0) {
            $model = Coupon::find($request->post('id'));
            $msg = 'Coupon Update Successfully';
        } else {
            $model = new Coupon();
            $msg = 'Coupon Add Successfully';
            $model->status = 1;
        }
        
        $model->title = $request->post('title');
        $model->code = $request->post('code');
        $model->value = $request->post('value');
        $model->type = $request->post('type');
        $model->min_ord_amt = $request->post('min_ord_amt');
        $model->is_one_time = $request->post('is_one_time');
        $model->save();
        session()->flash('msg',$msg);
        return redirect('/counter/coupon');

    }
    
    public function destroy(Request $request, $id)
    {
        $model = Coupon::find($id);
        $model->delete();
        session()->flash('msg','Coupon Delete Successfully');
        return redirect('/counter/coupon');
    }
}
