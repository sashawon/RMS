@extends('counter/layout')
@section('page_title','Add Type')
@section('type_select','active')

@section('container')
<div class="col-12">
    <div class="overview-wrap">
        <h2 class="title-1">Add Type</h2>
    </div>
    <div class="overview-wrap m-t-30">
        <a class="btn btn-success" href="{{url('/counter/type')}}">BACK</a>
    </div>
	<div class="row m-t-30">
	    <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('type.manage_type_process')}}" method="post" enctype= multipart/form-data>
                        @csrf
                        <div class="row d-flex justify-content-center ">
                            <div class="col-10">
                                <div class="form-group">
                                    <label for="type_name" class="control-label mb-1">Type</label>
                                    <input id="type_name" name="type_name" type="text" class="form-control" value="{{$type_name}}" required="">
                                    @error('type_name')
                                        <div class="alert alert-danger" role="alert">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <label for="is_home" class="control-label mb-1">Show in Home Page</label>
                                    <input id="is_home" name="is_home" type="checkbox" {{$is_home_selected}}>
                                    @error('is_home')
                                        <div class="alert alert-danger" role="alert">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center">
                            <div class="col-10">
                                <div class="form-group">
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="{{$id}}">
                    </form>
                </div>
            </div>
        </div>
	</div>
</div>
@endsection