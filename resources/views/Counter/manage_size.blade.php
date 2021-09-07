@extends('counter/layout')
@section('page_title','Add Size')
@section('size_select','active')

@section('container')
<div class="col-12">
    <div class="overview-wrap">
        <h2 class="title-1">Add Size</h2>
    </div>
    <div class="overview-wrap m-t-30">
        <a class="btn btn-success" href="{{url('/counter/size')}}">BACK</a>
    </div>
	<div class="row m-t-30">
	    <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('size.manage_size_process')}}" method="post" enctype= multipart/form-data>
                        @csrf
                        <div class="row d-flex justify-content-center ">
                            <div class="col-10">
                                <div class="form-group">
                                    <label for="size_name" class="control-label mb-1">Size</label>
                                    <input id="size_name" name="size_name" type="text" class="form-control" value="{{$size_name}}" required="">
                                    @error('size_name')
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