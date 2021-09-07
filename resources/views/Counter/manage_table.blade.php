@extends('counter/layout')
@section('page_title','Add Table')
@section('table_select','active')

@section('container')
<div class="col-12">
    <div class="overview-wrap">
        <h2 class="title-1">Add Table</h2>
    </div>
    <div class="overview-wrap m-t-30">
        <a class="btn btn-success" href="{{url('/counter/table')}}">BACK</a>
    </div>
	<div class="row m-t-30">
	    <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('table.manage_table_process')}}" method="post" enctype= multipart/form-data>
                        @csrf
                        <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="table_no" class="control-label mb-1">table</label>
                                    <input id="table_no" name="table_no" type="text" class="form-control" value="{{$table_no}}" required="">
                                    @error('table_no')
                                        <div class="alert alert-danger" role="alert">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="table_users" class="control-label mb-1">Table User</label>
                                    <input id="table_users" name="table_users" type="text" class="form-control" value="{{$table_users}}" required="">
                                    @error('table_users')
                                        <div class="alert alert-danger" role="alert">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-5">
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