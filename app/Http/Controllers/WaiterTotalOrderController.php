<?php

namespace App\Http\Controllers;

use App\Models\Waiter\WaiterTotalOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WaiterTotalOrderController extends Controller
{
    public function index()
    {
        $TABLE_ID = session('TABLE_ID');
        $result['placeOrder']=DB::table('collect_orders')
                            ->leftjoin('total_waiters', 'collect_orders.table_id', '=', 'total_waiters.table_id')
                            ->leftjoin('total_tables', 'collect_orders.table_id', '=', 'total_tables.id')
                            ->select('collect_orders.id','collect_orders.token','total_tables.table_no','collect_orders.created_at','collect_orders.status')
                            ->where('collect_orders.table_id', '=', $TABLE_ID)
                            ->get();

        // echo"<pre>";
        // print_r($result);
        // die();

        return view('waiter/totalorder',$result);
    }

    public function orderDetails(Request $request, $id)
    {
        $result['placeOrderDetalis']=DB::table('collect_orders_attr')->where('token','=',$id)->get();
        $placeOrder=DB::table('collect_orders')->where('token','=',$id)->get();

        echo $response = '<table class="table"><tr><td><b>Table No: </b></td><td>'.$placeOrder[0]->table_id.'</td></tr><tr><td><b>Token: </b></td><td>'.$placeOrder[0]->token.'</td></tr><tr><td><b>Order Time: </b></td><td>'.$placeOrder[0]->created_at.'</td></tr><tr><td><b>Status: </b></td><td>'.$placeOrder[0]->status.'</td></tr></table>';

        echo $response = '<table class="table table-bordered table-striped"><thead><tr><th>ID</th><th>Items Name</th><th>QTY</th><th>Size</th><th>Flavor</th><th>Rate</th><th>Total</th><th>Discount Total</th><th>Order Type</th></tr></thead><tbody>';
        $i = '1';
        $grandTotal = 0;
        foreach ($result['placeOrderDetalis'] as $ordervalue) {
            echo $response = '<tr>
                <td>'.$i++.'</td>
                <td>'.$ordervalue->items_id.'</td>
                <td>'.$ordervalue->qty.'</td>
                <td>'.$ordervalue->size_id.'</td>
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
}
