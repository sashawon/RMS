<?php

namespace App\Http\Controllers;

use App\Models\Counter\TotalOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;

class TotalOrderController extends Controller
{
    public function index()
    {
        $result['placeOrder']=DB::table('collect_orders')
                            ->leftjoin('total_tables', 'collect_orders.table_id', '=', 'total_tables.id')
                            ->select('collect_orders.id','collect_orders.token','total_tables.table_no','collect_orders.created_at','collect_orders.status')
                            ->orderByDesc('collect_orders.id')
                            ->get();

        return view('counter/totalorder',$result);
    }

    public function orderDetails(Request $request, $id)
    {
        $result['placeOrderDetalis']=DB::table('collect_orders_attr')
                                    ->leftjoin('items', 'collect_orders_attr.items_id', '=', 'items.id')
                                    ->leftjoin('total_tables', 'collect_orders_attr.table_id', '=', 'total_tables.id')
                                    ->leftJoin('sizes','collect_orders_attr.size_id','=','sizes.id')
                                    // ->leftJoin('types','collect_orders_attr.type_id','=','types.id')
                                    ->select('collect_orders_attr.id', 'collect_orders_attr.table_id', 'collect_orders_attr.items_id', 'collect_orders_attr.items_attr_id', 'collect_orders_attr.qty', 'collect_orders_attr.rate', 'collect_orders_attr.total', 'collect_orders_attr.discount_val', 'collect_orders_attr.discount_type', 'collect_orders_attr.discount', 'collect_orders_attr.discount_total', 'collect_orders_attr.size_id', 'collect_orders_attr.flavor', 'collect_orders_attr.order_type', 'collect_orders_attr.token', 'collect_orders_attr.status', 'items.name', 'sizes.size_name')
                                    ->where('token','=',$id)
                                    ->get();

        $placeOrder=DB::table('collect_orders')
                    ->where('token','=',$id)
                    ->get();

        // echo "<pre>"; print_r($result); die();

        echo $response = '<table class="table"><tr><td><b>Table No: </b></td><td>'.$placeOrder[0]->table_id.'</td></tr><tr><td><b>Token: </b></td><td>'.$placeOrder[0]->token.'</td></tr><tr><td><b>Order Time: </b></td><td>'.$placeOrder[0]->created_at.'</td></tr><tr><td><b>Status: </b></td><td>'.$placeOrder[0]->status.'</td></tr></table>';

        echo $response = '<table class="table table-bordered table-striped"><thead><tr><th>No</th><th>Items Name</th><th>QTY</th><th>Size</th><th>Flavor</th><th>Rate</th><th>Total</th><th>Discount Total</th><th>Order Type</th></tr></thead><tbody>';
        $i = '1';
        $grandTotal = 0;
        foreach ($result['placeOrderDetalis'] as $ordervalue) {
            echo $response = '<tr>
                <td>'.$i++.'</td>
                <td>'.$ordervalue->name.'</td>
                <td>'.$ordervalue->qty.'</td>
                <td>'.$ordervalue->size_name.'</td>
                <td>'.$ordervalue->flavor.'</td>
                <td>'.$ordervalue->rate.'</td>
                <td>'.$ordervalue->total.'</td>
                <td>'.$ordervalue->discount_total.'</td>
                <td>'.$ordervalue->order_type.'</td>
            </tr>';

            $grandTotal = $grandTotal + $ordervalue->discount_total;
        }

        echo $response = '<tr><td colspan="7"><b>Total</b></td><td colspan="2"><b>'.$grandTotal.'/-</b></td></tr>';

        echo $response = '</tbody></table>';
    }

    public function order_status_update(Request $request, $id)
    {
        $status = $_GET['status'];

        DB::table('collect_orders')->where('token','=',$id)->update(['status'=>$status]);
        DB::table('collect_orders_attr')->where('token','=',$id)->update(['status'=>$status]);
    }

    public function manage_total_order(Request $request, $id)
    {
        $result['order_data'] = DB::table('collect_orders')->where('token','=',$id)->get();
        $result['table'] = DB::table('total_tables')->get();
        // echo "<pre>"; print_r($result); die();

        return view('counter/manage_order',$result);
    }

    public function manage_total_order_process(Request $request)
    {
        // echo "<pre>"; print_r($_POST); die();
        
        $table_no = $_POST['table_no'];
        $order_id = $_POST['order_id'];
        $order_token = $_POST['order_token'];

        DB::table('collect_orders')->where('id','=',$order_id)->update(['table_id'=>$table_no]);
        DB::table('collect_orders_attr')->where('token','=',$order_token)->update(['table_id'=>$table_no]);

        $msg = 'Table Update Successfully';
        session()->flash('msg',$msg);
        return redirect('/counter/totalorder');
    }

    
}
