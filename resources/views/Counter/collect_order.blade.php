@extends('counter/layout')
@section('page_title','Collect Order')
@section('collect_order','active')

@section('container')
<div class="col-md-8 col-lg-8">
    <!-- Food Category -->
    <div class="statistic-chart-1">
        <h3 class="title-3 m-b-30">Category</h3>
        <div class="container">
            <div class="row text-center">
                @foreach($category as $list)
                <div class="col-3"><a class="d-block bg-info text-white p-2 m-1" href="javascript:void(0)" onclick="category_item('{{$list->id}}')">{{$list->category_name}}</a></div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- END Food Category-->
    <!-- Food Item-->
    <div class="top-campaign">
        <div class="table-responsive">
            <div class="tab-content"  id="itemTable">
                <div class="tab-pane active" id="tab_15">
                    <b class="text-bold">
                        <span class="glyphicon glyphicon-refresh"></span>
                        All Items
                    </b>
                    <hr>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr class="bg-success" style="font-family: cursive;font-size: 14px; color: #fff;">
                                <td>Picture</td>
                                <td>Product</td>
                                <td>Quantity</td>
                                <td>Rate</td>
                                <td>Discount</td>
                                <!-- <td>Type</td> -->
                                <td>Size</td>
                                <td>Flavor</td>
                                <td>Order Type</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @php
                                $loop_count_num = 0;
                            @endphp
                            @foreach($category as $list)
                            @foreach($all_item[$list->id] as $item_arr)
                            @foreach($all_item_attr[$item_arr->id] as $all_item_arr)
                            @php
                                $loop_count_num++;
                            @endphp
                            <tr>
                                <td>
                                    <img class="img-responsive" src="{{asset('storage/item_attr/'.$all_item_arr->attr_image)}}" alt="{{$item_arr->name}}" style="height: 80px; width: 120px;">
                                </td>
                                <td>
                                    <span value="{{$item_arr->name}}">{{$item_arr->name}}</span>
                                    <input type="hidden" id="item_arr_name{{$loop_count_num}}" value="{{$item_arr->name}}">
                                    <input type="hidden" id="item_arr_id{{$loop_count_num}}" value="{{$item_arr->id}}">
                                    <input type="hidden" id="all_item_arr_id{{$loop_count_num}}" value="{{$all_item_arr->id}}">
                                </td>
                                <td><input type="number" class="form-control" id="qty{{$loop_count_num}}" value="1" size="2" style="text-align: center; font-family: cursive; height: 40px; width: 60px; font-size: 30px;"></td>
                                <td>
                                    <span style="font-size: 15px; font-weight: bold;">{{$all_item_arr->price}}</span>
                                    <input type="hidden" id="rate{{$loop_count_num}}" value="{{$all_item_arr->price}}">
                                </td>
<!--                                 <td>
                                    <span>{{$all_item_arr->type_name}}</span>
                                    <input type="hidden" id="item_arr_type{{$loop_count_num}}" value="{{$all_item_arr->type_id}}">
                                </td> -->
                                <td>
                                    @php
                                    $dis = '';
                                    if($all_item_arr->discount_type == 'val'){
                                        $dis = 'TK';
                                    } else {
                                        $dis = '%';
                                    }
                                    @endphp
                                    <span>{{$all_item_arr->discount}}{{$dis}}</span>
                                    <input type="hidden" id="discount{{$loop_count_num}}" value="{{$all_item_arr->discount}}">
                                    <input type="hidden" id="discount_type{{$loop_count_num}}" value="{{$dis}}">
                                    <input type="hidden" id="discount_type_val{{$loop_count_num}}" value="{{$all_item_arr->discount_type}}">
                                </td>
                                <td>
                                    <span>{{$all_item_arr->size_name}}</span>
                                    <input type="hidden" id="item_arr_size{{$loop_count_num}}" value="{{$all_item_arr->size_id}}">
                                </td>
                                <td>
                                    <input type="radio" checked="" id="flavor{{$loop_count_num}}" name="flavor{{$loop_count_num}}" value="Reguler"> Reguler<br>
                                    <input type="radio" id="flavor{{$loop_count_num}}" name="flavor{{$loop_count_num}}" value="Spicy"> Spicy<br>
                                    <input type="radio" id="flavor{{$loop_count_num}}" name="flavor{{$loop_count_num}}" value="Extra Spicy"> Extra Spicy<br>
                                </td>
                                <td>
                                    <input type="radio" checked="" id="ordertype{{$loop_count_num}}" name="ordertype{{$loop_count_num}}" value="Heaving"> Heaving
                                    <br>
                                    <input type="radio" id="ordertype{{$loop_count_num}}" name="ordertype{{$loop_count_num}}" value="Parcel"> Parcel
                                </td>
                                <td>
                                    <span class="btn btn-primary btn-block" onclick="add_to_cart('{{$loop_count_num}}','{{$all_item_arr->id}}')">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                        <span style="padding-left: 5px">Add</span>
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                            @endforeach
                            @endforeach
                            @foreach($vat as $vatval)
                                    <input type="hidden" id="vat_value" name="vat_value" value="{{$vatval->vat_value}}">
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- END Food Item-->
</div>
<div class="col-md-4 col-lg-4">
    <!-- Invoice Summery-->
    <div class="invoice_summery bg-white" style="font-size: 12px;">
        <h3 class="title-3 p-3">Invoice Summery</h3>
        <div class="col-12">

            <form action="{{route('counter.order')}}" method="post"> 
                @csrf
                <table class="table table-bordered table-stripede" style="background-color:white;width: 100%">
                    <tbody>
                        <!-- <tr>
                            <th class="text-center" style="width: 40%;">
                                <span class="glyphicon glyphicon-upload"></span>
                                <span style="padding-left:5px">Token :</span> 
                            </th>
                            <td style="width: 60%;">
                                <span id="confirm_token">not found</span> 
                            </td> 
                        </tr>
                        <tr>
                            <th class="text-center">
                                <span style="padding-left:5px">Order Type :</span>  
                            </th>
                            <td>
                                <span id="type_order" class="badge" style="color:white">Heaving</span>
                            </td> 
                        </tr> -->
                        <tr>
                            <th class="text-center">
                                <span style="padding-left:5px">Table No :</span>  
                            </th>
                            <td>
                                <select name="table_no" id="table_no" style="width: 100%; font-size: 15px;">
                                    @foreach($table_no as $table)
                                    <option value="{{$table->id}}">{{$table->table_no}}</option>
                                    @endforeach
                                </select>
                            </td> 
                        </tr>
                    </tbody>
                </table>
                <div id="show_sales_cart">
                    <table class="table table-bordered table-stripede" style="background-color:white; width: 100%; margin: 10px 0px;"> 
                        <thead> 
                            <tr>
                                <th><span class="glyphicon glyphicon-th"><i class="fa fa-trash" style="color:black"></i></span></th>
                                <th>Item</th>
                                <th>Qty</th>
                                <th>Rate</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody id="item_tablebody">
                            @foreach($cart as $cart_data)
                            @if($cart_data)
                            <tr style="background-color: #f4f4f4;" id="item_count_{{$cart_data->id}}">
                                <td>
                                    <input type="hidden" name="cart_id" value="{{$cart_data->id}}">
                                    <a href="javascript:void(0)">
                                        <i class="fa fa-trash" style="color:black" onclick="delete_product('{{$cart_data->id}}')"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" id="item_name">{{$cart_data->name}}</a>
                                    <input type="hidden" name="item_name" value="{{$cart_data->id}}">
                                </td>
                                <td>
                                    <input type="number" id="item_qty_{{$cart_data->id}}" size="2" style="text-align: center; font-family: cursive; height: 50px; width: 40px; font-size: 25px;" onclick="update_qty('{{$cart_data->id}}')" value="{{$cart_data->qty}}">
                                </td>
                                <td>
                                    <span style="font-size: 25px;">{{$cart_data->rate}}</span>
                                    <input type="hidden" id="item_rate_{{$cart_data->id}}" value="{{$cart_data->rate}}"> 
                                </td>
                                <td> <span id="total_{{$cart_data->id}}" style="font-size: 25px;">{{$cart_data->rate*$cart_data->qty}}</span> </td> 
                            </tr>
                            @else
                            <tr style="background-color: #f4f4f4;" id="item_count_">
                                <td>
                                    <a href="javascript:void(0)">
                                        <i class="fa fa-trash" style="color:black"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" id="item_name"></a>
                                </td>
                                <td> 
                                    <span id="item_qty" style="font-size: 25px;">0</span>
                                </td>
                                <td> <span id="item_rate" style="font-size: 25px;">0</span> </td>
                                <td> <span id="total" style="font-size: 25px;">0</span> </td> 
                            </tr>

                            @endif
                            @endforeach
                        </tbody> 
                    </table>
                    <!-- <input type="hidden" name="cart_total_item" id="cart_total_item" value="1">
                    <input type="hidden" name="cart_grand_total_vat" id="cart_grand_total_vat" value="29">
                    <input type="hidden" name="cart_grand_total_amount" id="cart_grand_total_amount" value="150"> -->

                </div>

                <div class="row" id="invoice_body">
                    <div class="col-12">
                        <div class="row">
                            @php
                            $grand_amount = 0;
                            $discount = 0;
                            $discount_total = 0;
                            $$vat = 0;
                            $total_vat = 0;
                            $payable_amount = 0;
                            @endphp

                            @foreach($cart as $cart_data)
                            @php
                            $grand_amount = $grand_amount+($cart_data->total);
                            $discount_total = $discount_total+$cart_data->discount_total;
                            $discount = $grand_amount - $discount_total;
                            $vat = $vatval->vat_value / 100;
                            $total_vat = $discount_total*$vat;
                            $payable_amount = $discount_total+$total_vat;
                            
                            @endphp
                            @endforeach
                            <div class="form-group col-md-6"> 
                                <label for="grand_amount">Grand Amount </label>
                                <span id="grand_amount" class="form-control" readonly="" style="background: #fff;  font-family: cursive; height: 40px;  font-size: 20px;">{{$grand_amount}}</span>
                            </div> 
                            <div class="form-group col-md-6"> 
                                <label for="discount_amount">Discount Amount <span id="view_percent_discount"></span></label>
                                <span id="discount_amount" class="form-control" readonly="" style="background: #fff;  font-family: cursive; height: 40px;  font-size: 20px;">{{$discount}}</span>
                                <!-- <input type="hidden" name="flat_discount_amount" id="flat_discount_amount" value="0">
                                <input type="hidden" name="percentage_discount_amount" id="percentage_discount_amount" value="0"> -->
                            </div> 
                            <div class="form-group col-md-6"> 
                                <label for="vat_amount">Vat Amount </label>
                                <span id="vat_amount" class="form-control" readonly="" style="background: #fff;  font-family: cursive; height: 40px;  font-size: 20px;">{{$total_vat}}</span>
                            </div>
                            <div class="form-group col-md-6"> 
                                <label for="payable_amount">Payable Amount </label>
                                <span id="payable_amount" class="form-control" readonly="" style="background: #fff;  font-family: cursive; height: 40px;  font-size: 20px;">{{$payable_amount}}</span>
                            </div> 
                            <div class="form-group col-md-6"> 
                                <label for="paid_amount">Paid Amount </label>
                                <input type="number" name="paid_amount" id="paid_amount" value="0.00" class="form-control" style="background: #fff;  font-family: cursive; height: 40px;  font-size: 30px;">
                            </div> 
                            <div class="form-group col-md-6"> 
                                <label for="change_amount">Change Amount </label>
                                <input type="number" name="change_amount" id="change_amount" value="0.00" class="form-control" style="background: #fff;  font-family: cursive; height: 40px;  font-size: 30px;">
                            </div> 
                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top: 10px; margin-bottom: 10px"> 
                        <div class="row">
                        <div class="col-6" style="padding: 5px !important; "> 
                            <input type="submit" name="online_payment" class="btn btn-info btn-block" value="Online Payment">
                        </div>
                        <div class="col-6" style="padding: 5px !important; ">
                            <input type="submit" name="offline_payment" class="btn btn-info btn-block" value="Offline Payment">
                        </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-12">  
                        <div class="form-group col-md-12"> 
                            <label for="confirm_btn"> </label>
                            <button type="submit" class="btn btn-success btn-block" id="confirm_btn">Confirm Order</button>
                        </div> 
                    </div>  -->
                </div> 
            </form>
        </div>
    </div>
    <!-- END Invoice Summery-->
</div>

@endsection