@extends('counter/layout')
@section('page_title','Manage Total Order')
@section('totalorder_select','active')

@section('container')
<div class="col-12">
    <div class="overview-wrap">
        <h2 class="title-1">Manage Total Order</h2>
    </div>
    <div class="overview-wrap m-t-30">
        <a class="btn btn-success" href="{{url('/counter/collect_order')}}">Create Order</a>
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
                            <th>No</th>
                            <th>Token</th>
                            <th>Table No</th>
                            <th>Order Time</th>
                            <th>Payment Status</th>
                            <th>Order Details</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 1;
                        @endphp
                        @foreach($placeOrder as $orders)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$orders->token}}</td>
                            <td>{{$orders->table_no}}</td>
                            <td>{{$orders->created_at}}</td>
                            <td>
                                <select name="status" class="status_{{$orders->token}}" id="status_{{$orders->token}}" onchange="status('{{$orders->token}}')">
                                    <option value="Painding" {{$orders->status == "Painding" ? 'selected' : ''}}>Painding</option>
                                    <option value="Confirmed" {{$orders->status == "Confirmed" ? 'selected' : ''}}>Confirmed</option>
                                    <option value="Processing" {{$orders->status == "Processing" ? 'selected' : ''}}>Processing</option>
                                    <option value="Ready" {{$orders->status == "Ready" ? 'selected' : ''}}>Ready</option>
                                    <option value="Delivered" {{$orders->status == "Delivered" ? 'selected' : ''}}>Delivered</option>
                                    <option class="text-danger" value="Denied" {{$orders->status == "Denied" ? 'selected' : ''}}>Denied</option>
                                </select>
                            </td>
                            <td>
                                <button type="button" onclick="view_order_data_details('{{$orders->token}}')" id="{{$orders->token}}" class="view_order_data_details btn-sm btn-success mb-1" data-toggle="modal" data-target="#orderdetails">
                                    Details
                                </button>
                            </td>
                            <td>
                                <a class="btn-sm btn-primary" href="{{url('/counter/totalorder/manage_total_order')}}/{{$orders->token}}">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>
</div>
@endsection