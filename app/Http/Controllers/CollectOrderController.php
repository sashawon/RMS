<?php

namespace App\Http\Controllers;

use App\Models\Counter\CollectOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;

class CollectOrderController extends Controller
{
    public function index(Request $request)
    {
        $result['category']=DB::table('categories')
                            ->where(['status'=>1])
                            ->where(['is_home'=>1])
                            ->get();

        foreach ($result['category'] as $list) {
            $result['all_item'][$list->id] = DB::table('items')
                                            ->where(['status'=>1])
                                            ->where(['category_id'=>$list->id])
                                            ->get();
            foreach ($result['all_item'][$list->id] as $list1) {
                $result['all_item_attr'][$list1->id] = DB::table('items_attr')
                                                    ->leftJoin('sizes','items_attr.size_id','=','sizes.id')
                                                    ->leftJoin('types','items_attr.type_id','=','types.id')
                                                    ->select('items_attr.id','items_attr.price','items_attr.attr_image','items_attr.type_id','items_attr.discount_type','items_attr.discount','items_attr.size_id','sizes.size_name','types.type_name')
                                                    ->where(['items_attr.item_id'=>$list1->id])
                                                    ->get();
            }
        }

        $result['vat']=DB::table('vats')
                      ->get();

        $result['table_no']=DB::table('total_tables')
                      ->get();

        $result['cart']=DB::table('cart')
                       ->leftJoin('items', 'cart.items_id', '=', 'items.id')
                       ->leftJoin('items_attr', 'cart.items_attr_id', '=', 'items_attr.id')
                       ->select('cart.id', 'cart.table_id', 'cart.items_id', 'cart.items_attr_id', 'cart.qty', 'cart.rate', 'cart.total', 'cart.discount_val', 'cart.discount_type', 'cart.discount', 'cart.discount_total', 'cart.size_id', 'cart.flavor', 'cart.order_type', 'items.name')
                       ->get();

        // echo "<pre>";
        // print_r($result);
        // die();


        return view('counter/collect_order',$result);
    }

    public function get_category_data(Request $request, $id)
    {
        $result['category']=DB::table('categories')
                            ->where(['id'=>$id])
                            ->where(['status'=>1])
                            ->where(['is_home'=>1])
                            ->get();

        foreach ($result['category'] as $list) {
            $result['all_item'][$list->id] = DB::table('items')
                                            ->where(['status'=>1])
                                            ->where(['category_id'=>$list->id])
                                            ->get();
            foreach ($result['all_item'][$list->id] as $list1) {
                $result['all_item_attr'][$list1->id] = DB::table('items_attr')
                                                    ->leftJoin('sizes','sizes.id','=','items_attr.size_id')
                                                    ->leftJoin('types','types.id','=','items_attr.type_id')
                                                    ->select('items_attr.id','items_attr.price','items_attr.attr_image','items_attr.type_id','items_attr.discount_type','items_attr.discount','items_attr.size_id','sizes.size_name','types.type_name')
                                                    ->where(['items_attr.item_id'=>$list1->id])
                                                    ->get();
            }
        }

        $result['vat']=DB::table('vats')
                       ->get();

        // echo "<pre>";
        // print_r($result);
        // die();

        $loop_count_num = 0;
        foreach($result['category'] as $list){
            echo $response = '<div class="tab-pane active" id="tab_15">
                    <b class="text-bold">
                        <span class="glyphicon glyphicon-refresh"></span>
                        '.$list->category_name.'
                    </b>
                    <hr>
                    <table class="table table-bordered table-striped" id="itemTable">
                        <thead>
                            <tr class="bg-success" style="font-family: cursive;font-size: 14px; color: #fff;">
                                <td>Picture</td>
                                <td>Product</td>
                                <td>Quantity</td>
                                <td>Rate</td>
                                <td>Discount</td>
                                <td>Size</td>
                                <td>Flavor</td>
                                <td>Order Type</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>';
            if(isset($result['all_item'][$list->id][0])){
                foreach($result['all_item'][$list->id] as $item_arr){
                    foreach($result['all_item_attr'][$item_arr->id] as $all_item_arr){
                        $loop_count_num++;
                        $dis = '';
                        if ($all_item_arr->discount_type == 'val'){
                            $dis = ' TK';
                        } else {
                            $dis = ' %';
                        }
                        
                        echo $response = '
                            <tr>
                                <td>
                                    <img class="img-responsive" src="'.asset('storage/item_attr/'.$all_item_arr->attr_image).'" alt="'.$item_arr->name.'" style="height: 80px; width: 120px;">
                                </td>
                                <td>
                                    <span id="item_arr_name" value="'.$item_arr->name.'">'.$item_arr->name.'</span>
                                    <input type="hidden" id="item_arr_name'.$loop_count_num.'" value="'.$item_arr->name.'">
                                    <input type="hidden" id="item_arr_id'.$loop_count_num.'" value="'.$item_arr->id.'">
                                    <input type="hidden" id="all_item_arr_id'.$loop_count_num.'" value="'.$all_item_arr->id.'">
                                </td>
                                <td><input type="number" class="form-control" id="qty'.$loop_count_num.'" value="1" size="2" style="text-align: center; font-family: cursive; height: 40px; width: 60px; font-size: 30px;"></td>
                                <td>
                                    <span style="font-size: 15px; font-weight: bold;">'.$all_item_arr->price.'</span>
                                    <input type="hidden" id="rate'.$loop_count_num.'" value="'.$all_item_arr->price.'">
                                </td>
                                <td>
                                    <span>'.$all_item_arr->discount.''.$dis.'</span>
                                    <input type="hidden" id="discount'.$loop_count_num.'" value="'.$all_item_arr->discount.'">
                                    <input type="hidden" id="discount_type'.$loop_count_num.'" value="'.$dis.'">
                                    <input type="hidden" id="discount_type_val'.$loop_count_num.'" value="'.$all_item_arr->discount_type.'">
                                </td>
                                <td>
                                    <span>'.$all_item_arr->size_name.'</span>
                                    <input type="hidden" id="item_arr_size'.$loop_count_num.'" value="'.$all_item_arr->size_id.'">
                                </td>
                                <td>                                   
                                    <input type="radio" checked="" id="flavor'.$loop_count_num.'" name="flavor'.$loop_count_num.'" value="Reguler"> Reguler<br>
                                    <input type="radio" id="flavor'.$loop_count_num.'" name="flavor'.$loop_count_num.'" value="Spicy"> Spicy<br>
                                    <input type="radio" id="flavor'.$loop_count_num.'" name="flavor'.$loop_count_num.'" value="Extra Spicy"> Extra Spicy<br>
                                </td>
                                <td>
                                    <input type="radio" checked="" id="ordertype'.$loop_count_num.'" name="ordertype'.$loop_count_num.'" value="Heaving"> Heaving
                                    <br>
                                    <input type="radio" id="ordertype'.$loop_count_num.'" name="ordertype'.$loop_count_num.'" value="Parcel"> Parcel
                                </td>
                                <td>
                                    <span class="btn btn-primary btn-block" onclick="add_to_cart('.$loop_count_num.','.$all_item_arr->id.')">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                        <span style="padding-left: 5px">Add</span>
                                    </span>
                                </td>
                            </tr>
                        ';
                    }
                }                
            } else {
                echo $response = '
                                <tr>
                                  <figure>
                                    No Data Found!
                                  </figure>
                                </tr>
                '; 
            }

            foreach($result['vat'] as $vatval){
                echo $response = '
                    <input type="hidden" id="vat_value" name="vat_value" value="'.$vatval->vat_value.'">
                ';
            }
            echo $response = '</tbody>
                    </table>
                </div>';
        }

        // return view('counter/collect_order',$result);
    }

    public function cart_data(Request $request, $id)
    {
        $item_arr_id = $_GET['item_arr_id'];
        $all_item_arr_id = $_GET['all_item_arr_id'];
        $qty = $_GET['qty'];
        $rate = $_GET['rate'];
        $total_rate = $_GET['total_rate'];
        $discount = $_GET['discount'];
        $discount_type = $_GET['discount_type_val'];
        $discountval = $_GET['discountval'];
        $discounttotal = $_GET['discounttotal'];
        $size = $_GET['size'];
        $flavorval = $_GET['flavorval'];
        $ordertypeval = $_GET['ordertypeval'];

        // echo "<pre>";
        // print_r($_GET);
        // die();

        DB::table('cart')->insert([
            'table_id'=>0,
            'items_id'=>$item_arr_id,
            'items_attr_id'=>$all_item_arr_id,
            'qty'=>$qty,
            'rate'=>$rate,
            'total'=>$total_rate,
            'discount_val'=>$discount,
            'discount_type'=>$discount_type,
            'discount'=>$discountval,
            'discount_total'=>$discounttotal,
            'size_id'=>$size,
            'flavor'=>$flavorval,
            'order_type'=>$ordertypeval
        ]);


        $letest=DB::table('cart')->latest('id')->first();

        $new_added_item=DB::table('cart')
                       ->where('cart.id', '=', $letest->id)
                       ->leftJoin('items', 'cart.items_id', '=', 'items.id')
                       ->leftJoin('items_attr', 'cart.items_attr_id', '=', 'items_attr.id')
                       ->select('cart.id', 'cart.table_id', 'cart.items_id', 'cart.items_attr_id', 'cart.qty', 'cart.rate', 'cart.total', 'cart.discount_val', 'cart.discount_type', 'cart.discount', 'cart.discount_total', 'cart.size_id', 'cart.flavor', 'cart.order_type', 'items.name')
                       ->get();

                       // echo "<pre>";
                       // print_r($new_added_item); die();

        $result['vat']=DB::table('vats')->get();
        foreach($result['vat'] as $vatval){
                $vats = $vatval->vat_value;
            }


        $grandTotal = DB::table('cart')->sum('total');
        $grandDiscountTotal = DB::table('cart')->sum('discount_total');
        $totalDiscountVal = $grandTotal - $grandDiscountTotal;
        $vat_per = $vats/100;
        $total_vat = $vat_per * $grandDiscountTotal;
        $payable_amount = $grandDiscountTotal + $total_vat;

        echo $response = '
                        <tr style="background-color: #f4f4f4;" id="item_count_'.$new_added_item[0]->id.'">
                            <input type="hidden" id="" value="'.$new_added_item[0]->id.'">

                            <td><a href="javascript:void(0)"><i class="fa fa-trash" style="color:black" onclick="delete_product('.$new_added_item[0]->id.')"></i></a></td>

                            <td><a href="javascript:void(0)" id="item_name">'.$new_added_item[0]->name.'</a></td>

                            <td><input type="number" id="item_qty_'.$new_added_item[0]->id.'" name="item_qty" value="'.$letest->qty.'" style="text-align: center; font-family: cursive; height: 50px; width: 40px; font-size: 25px;" onclick="update_qty('.$new_added_item[0]->id.')"></td>

                            <td> <span style="font-size: 25px;">'.$new_added_item[0]->rate.'</span> <input id="item_rate_'.$new_added_item[0]->id.'" type="hidden" value="'.$new_added_item[0]->rate.'"> </td>

                            <td> <span id="total_'.$new_added_item[0]->id.'" style="font-size: 25px;">'.$new_added_item[0]->total.'</span> </td>

                        </tr>
        ';

        echo $response = '
                        <script>
                            document.getElementById("grand_amount").innerHTML='.$grandTotal.';
                            document.getElementById("discount_amount").innerHTML='.$totalDiscountVal.';
                            document.getElementById("vat_amount").innerHTML='.$total_vat.';
                            document.getElementById("payable_amount").innerHTML='.$payable_amount.';
                        </script>
        ';
        
    }

    public function cart_data_update(Request $request, $id)
    {
        // echo "<pre>";
        // print_r($_GET);
        // die();

        $update_qty = $_GET['update_qty'];

        $data = DB::table('cart')->where('id','=',$id)->get();

        if ($data[0]->discount_type == 'per') {
            $discountval = ($data[0]->rate*$update_qty)*($data[0]->discount_val/100);
        } else {
            $discountval = $update_qty*$data[0]->discount_val;
        }

        $updateTotal = $update_qty * $data[0]->rate;
        $updateDiscountTotal = $updateTotal - $discountval;

        DB::table('cart')->where('id','=',$id)->update(['qty'=>$update_qty,'total'=>$updateTotal,'discount'=>$discountval,'discount_total'=>$updateDiscountTotal]);

        $result['vat']=DB::table('vats')->get();
        foreach($result['vat'] as $vatval){
                $vats = $vatval->vat_value;
            }


        $grandTotal = DB::table('cart')->sum('total');
        $grandDiscountTotal = DB::table('cart')->sum('discount_total');
        $totalDiscountVal = $grandTotal - $grandDiscountTotal;
        $vat_per = $vats/100;
        $total_vat = $vat_per * $grandDiscountTotal;
        $payable_amount = $grandDiscountTotal + $total_vat;

        echo $response = '
                        <script>
                            document.getElementById("total_'.$id.'").innerHTML='.$updateTotal.';
                            document.getElementById("grand_amount").innerHTML='.$grandTotal.';
                            document.getElementById("discount_amount").innerHTML='.$totalDiscountVal.';
                            document.getElementById("vat_amount").innerHTML='.$total_vat.';
                            document.getElementById("payable_amount").innerHTML='.$payable_amount.';
                        </script>
        ';
    }

    public function cart_data_dalete(Request $request, $id)
    {
        
        // echo "<pre>";
        // print_r($_GET);
        // die();
        DB::table('cart')->where('id','=',$id)->delete();

        $result['vat']=DB::table('vats')->get();
        foreach($result['vat'] as $vatval){
                $vats = $vatval->vat_value;
            }


        $grandTotal = DB::table('cart')->sum('total');
        $grandDiscountTotal = DB::table('cart')->sum('discount_total');
        $totalDiscountVal = $grandTotal - $grandDiscountTotal;
        $vat_per = $vats/100;
        $total_vat = $vat_per * $grandDiscountTotal;
        $payable_amount = $grandDiscountTotal + $total_vat;

        echo $response = '
                        <script>
                            jQuery("#item_count_'.$id.'").empty();
                            document.getElementById("grand_amount").innerHTML='.$grandTotal.';
                            document.getElementById("discount_amount").innerHTML='.$totalDiscountVal.';
                            document.getElementById("vat_amount").innerHTML='.$total_vat.';
                            document.getElementById("payable_amount").innerHTML='.$payable_amount.';
                        </script>
        ';
    }

    public function order()
    {
        if(isset($_POST['online_payment'])){
            echo "Online Payment is not Working Right now!";
        } else if(isset($_POST['offline_payment'])){
            // echo "<pre>";
            // print_r($_POST);

            $rand = rand('111111111','999999999');
            $token = time().$rand;
            $table = $_POST['table_no'];
            $status = 'Pending';
            $grand_total = 0;
            $discount_total = 0;

            $result['cart']=DB::table('cart')->where('table_id','=','0')->get();
            $result['vat']=DB::table('vats')->get();

            foreach($result['vat'] as $vatval){
                $vats = $vatval->vat_value;
            }

            foreach ($result['cart'] as $value) {
                // print_r($value);
                DB::table('collect_orders_attr')->insert([
                    'table_id' => $table,
                    'items_id' => $value->items_id,
                    'items_attr_id' => $value->items_attr_id,
                    'qty' => $value->qty,
                    'rate' => $value->rate,
                    'total' => $value->total,
                    'discount_val' => $value->discount_val,
                    'discount_type' => $value->discount_type,
                    'discount' => $value->discount,
                    'discount_total' => $value->discount_total,
                    'size_id' => $value->size_id,
                    'flavor' => $value->flavor,
                    'order_type' => $value->order_type,
                    'token' => $token,
                    'status' => $status
                ]);
                $grand_total = $grand_total+$value->total;
                $discount_total = $discount_total + $value->discount_total;
            }

            $vat_per = $vats/100;
            $total_vat = $vat_per * $discount_total;
            $payable_amount = $discount_total + $total_vat;

            DB::table('collect_orders')->insert([
                'table_id' => $table,
                'total' => $grand_total,
                'discount_total' => $discount_total,
                'payable_amount' => $payable_amount,
                'token' => $token,
                'status' => $status
            ]);

            DB::table('cart')->where('table_id','=','0')->delete();

            $msg = 'Order Added Successfully';

            session()->flash('msg',$msg);
            return redirect('/counter/totalorder');
        }
        // return view('counter/collect_order');
    }
}
