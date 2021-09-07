function category_item(id){
    //document.write(id);

    $.ajax({
        url: 'collect_order/'+id,
        type: 'get',
        success: function(response){
            $('#itemTable').empty(); 
            // console.log(response);
            $('#itemTable').html(response);
        }
   });
}


var loop_count=0;
var total_rate = 0;
var grand_amount=0;
var total_vat=0;
var payable_amount=0;
var discountval = 0;
var qtydiscountval = 0;
var totaldiscountval = 0;

function add_to_cart(loop_count_num, item_attr_id){
    // console.log(loop_count_num, item_attr_id);
    loop_count++;

    var item_arr_name = document.getElementById("item_arr_name"+loop_count_num).value;
    var item_arr_id = document.getElementById("item_arr_id"+loop_count_num).value;
    var all_item_arr_id = document.getElementById("all_item_arr_id"+loop_count_num).value;
    var qty = document.getElementById("qty"+loop_count_num).value;
    var rate = document.getElementById("rate"+loop_count_num).value;
    total_rate = qty*rate;
    var discount = document.getElementById("discount"+loop_count_num).value;
    var discount_type = document.getElementById("discount_type"+loop_count_num).value;
    var discount_type_val = document.getElementById("discount_type_val"+loop_count_num).value;
    var size = document.getElementById("item_arr_size"+loop_count_num).value;
    // var item_arr_type = document.getElementById("item_arr_type"+loop_count_num).value;
    var item_arr_size = document.getElementById("item_arr_size"+loop_count_num).value;
    var vat = (document.getElementById("vat_value").value/100);

    var flavor = document.getElementsByName("flavor"+loop_count_num);
    for (var i = 0; i < flavor.length; i++) {
        if(flavor[i].checked) {
            var flavorval = flavor[i].value;
        }
    }

    var ordertype = document.getElementsByName("ordertype"+loop_count_num);
    for (var i = 0; i < ordertype.length; i++) {
        if(ordertype[i].checked) {
            var ordertypeval = ordertype[i].value;
        }
    }

    if (discount_type == '%') {
        discountval = parseInt((rate*qty)*(discount/100));
    } else {
        discountval = parseInt(qty*discount);
    }

    var discounttotal = total_rate - discountval;

    jQuery.ajax({
        url: 'cart/'+loop_count_num,
        type: 'get',
        data: 'qty='+qty+'&item_arr_id='+item_arr_id+'&all_item_arr_id='+all_item_arr_id+'&rate='+rate+'&total_rate='+total_rate+'&discount='+discount+'&discount_type_val='+discount_type_val+'&discountval='+discountval+'&discounttotal='+discounttotal+'&size='+size+'&flavorval='+flavorval+'&ordertypeval='+ordertypeval,
        success: function(response){
            alert('Item Added Successfully!');
            $('#item_tablebody').append(response);
        }
    });
}

function update_qty(id){
    var update_qty = document.getElementById("item_qty_"+id).value;
    // console.log(update_qty);

    jQuery.ajax({
        url: 'cart_update/'+id,
        type: 'get',
        data: 'update_qty='+update_qty,
        success: function(response){
            // console.log(response);
            alert('Quantity Update Successfully!');
            $('#invoice_body').append(response);
        }
    });    
}

function delete_product(id){
    // console.log(id);
    var item_delete = document.getElementById(id);

    jQuery.ajax({
        url: 'cart_delete/'+id,
        type: 'get',
        success: function(response){
            alert('Item Removed Successfully!');
            $('#invoice_body').append(response);
        }
    });
}

function view_order_data_details(id){
    // console.log(id);
    var item_token = id;

    jQuery.ajax({
        url: 'order_details/'+id,
        type: 'get',
        success: function(response){
            // console.log(response);
            // alert('Item Removed Successfully!');
            $('.view_order_data_details_tab').html(response);
        }
    });
}

function status(id){
    var status = document.getElementById("status_"+id).value;
    // console.log(status);

    jQuery.ajax({
        url: 'order_status_update/'+id,
        type: 'get',
        data: 'status='+status,
        success: function(response){
            // console.log(response);
            alert('Order Status Successfully Change!');
        }
    });
}