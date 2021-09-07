@extends('waiter/layout')
@section('page_title','Manage Orders')
@section('totalorder_select','active')

@section('container')
<div class="col-12">
    <div class="overview-wrap">
        <h2 class="title-1">Manage Orders</h2>
    </div>
    <div class="row m-t-30">
        <div class="col-12">
            @if(session()->has('msg'))
            <div class="sufee-alert alert with-close alert-warning alert-dismissible fade show">
                {{session('msg')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            @endif
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-striped table-data3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Token</th>
                            <th>Table No</th>
                            <th>Order Time</th>
                            <th>Payment Status</th>
                            <th>Order Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 1;
                        @endphp
                        @foreach($placeOrder as $orders)
                        @if($orders->status)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$orders->token}}</td>
                            <td>{{$orders->table_no}}</td>
                            <td>{{$orders->created_at}}</td>
                            <td>
                                <select name="status" class="status_{{$orders->token}}" id="status_{{$orders->token}}" onchange="status('{{$orders->token}}')">
                                    <option value="Ready" {{$orders->status == "Ready" ? 'selected' : ''}}>Ready</option>
                                    <option value="Delivered" {{$orders->status == "Delivered" ? 'selected' : ''}}>Delivered</option>
                                </select>
                            </td>
                            <td>
                                <button type="button" onclick="view_order_data_details('{{$orders->token}}')" id="{{$orders->token}}" class="view_order_data_details btn-sm btn-success mb-1" data-toggle="modal" data-target="#orderdetails">
                                    Details
                                </button>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>
</div>
@endsection