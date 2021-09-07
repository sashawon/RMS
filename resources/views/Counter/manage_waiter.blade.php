@extends('counter/layout')
@section('page_title','Add Waiter')
@section('waiter_select','active')

@section('container')
<div class="col-12">
    <div class="overview-wrap">
        <h2 class="title-1">Add Waiter</h2>
    </div>
    <div class="overview-wrap m-t-30">
        <a class="btn btn-success" href="{{url('/counter/waiter')}}">BACK</a>
    </div>
	<div class="row m-t-30">
	    <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('waiter.manage_waiter_process')}}" method="post" enctype= multipart/form-data>
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name" class="control-label mb-1">Name</label>
                                    <input id="name" name="name" type="text" class="form-control" value="{{$name}}" required="">
                                    @error('name')
                                        <div class="alert alert-danger" role="alert">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="table_no" class="control-label mb-1">Category</label>
                                    <select name="table_no" id="table_no" class="form-control" required="">
                                            @foreach($table as $list)
                                                @if($id==$list->id)
                                                    <option selected="" value="{{$list->id}}">{{$list->table_no}}</option>
                                                @else
                                                    <option value="{{$list->id}}">{{$list->table_no}}</option>
                                                @endif
                                            @endforeach
                                    </select>
                                    @error('table_no')
                                        <div class="alert alert-danger" role="alert">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="username" class="control-label mb-1">Waiter User Name</label>
                                    <input id="username" name="username" type="text" class="form-control" value="{{$username}}" required="">
                                    @error('username')
                                        <div class="alert alert-danger" role="alert">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="password" class="control-label mb-1">Password</label>
                                    <input id="password" name="password" type="text" class="form-control" value="{{$password}}" required="">
                                    @error('password')
                                        <div class="alert alert-danger" role="alert">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div>
                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                Submit
                            </button>
                        </div>
                        <input type="hidden" name="id" value="{{$id}}">
                    </form>
                </div>
            </div>
        </div>
	</div>
</div>
@endsection