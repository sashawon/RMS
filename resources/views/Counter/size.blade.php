@extends('counter/layout')
@section('page_title','Manage Size')
@section('size_select','active')

@section('container')
<div class="col-12">
    <div class="overview-wrap">
        <h2 class="title-1">Manage Size</h2>
    </div>
    <div class="overview-wrap m-t-30">
        <a class="btn btn-success" href="{{url('/counter/size/manage_size')}}">ADD SIZE</a>
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
                            <th>Size Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $list)
                        <tr>
                            <td>{{$list->id}}</td>
                            <td>{{$list->size_name}}</td>
                            <td>
                                @if($list->status==1)
                                    <a class="btn-sm btn-primary" href="{{url('/counter/size/status/0')}}/{{$list->id}}">Active</a>
                                @elseif($list->status==0)
                                    <a class="btn-sm btn-warning" href="{{url('/counter/size/status/1')}}/{{$list->id}}">Deactive</a>
                                @endif
                                <a class="btn-sm btn-success" href="{{url('/counter/size/manage_size')}}/{{$list->id}}">Edit</a>
                                <a class="btn-sm btn-danger" href="{{url('/counter/size/delete')}}/{{$list->id}}">Delete</a>
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