@extends('counter/layout')
@section('page_title','Manage Item')
@section('item_select','active')

@section('container')
<div class="col-12">
    <div class="overview-wrap">
        <h2 class="title-1">Manage Item</h2>
    </div>
    <div class="overview-wrap m-t-30">
        <a class="btn btn-success" href="{{url('/counter/item/manage_item')}}">ADD ITEM</a>
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
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>SKU</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $list)
                        <tr>
                            <td>{{$list->id}}</td>
                            <td>{{$list->name}}</td>
                            <td>{{$list->slug}}</td>
                            <td>{{$list->sku}}</td>
                            <td>
                                @if($list->image!='')
                                    <img src="{{asset('storage/item/'.$list->image)}}" width="100px" alt="Item Image">
                                @endif
                            </td>
                            <td>
                                @if($list->status==1)
                                    <a class="btn-sm btn-primary" href="{{url('/counter/item/status/0')}}/{{$list->id}}">Active</a>
                                @elseif($list->status==0)
                                    <a class="btn-sm btn-warning" href="{{url('/counter/item/status/1')}}/{{$list->id}}">Deactive</a>
                                @endif
                                <a class="btn-sm btn-success" href="{{url('/counter/item/manage_item')}}/{{$list->id}}">Edit</a>
                                <a class="btn-sm btn-danger" href="{{url('/counter/item/delete')}}/{{$list->id}}">Delete</a>
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