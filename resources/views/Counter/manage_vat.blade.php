@extends('counter/layout')
@section('page_title','Manage VAT')
@section('vat_select','active')

@section('container')
<div class="col-12">
    <div class="overview-wrap">
        <h2 class="title-1">Add VAT</h2>
    </div>
    <div class="overview-wrap m-t-30">
        <a class="btn btn-success" href="{{url('/counter/vat')}}">BACK</a>
    </div>
	<div class="row m-t-30">
	    <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('vat.manage_vat_process')}}" method="post" enctype= multipart/form-data>
                        @csrf
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="vat_desc" class="control-label mb-1">Description</label>
                                    <input id="vat_desc" name="vat_desc" type="text" class="form-control" value="{{$vat_desc}}" required="">
                                    @error('vat_desc')
                                        <div class="alert alert-danger" role="alert">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="vat_value" class="control-label mb-1">vat (%)</label>
                                    <input id="vat_value" name="vat_value" type="number" class="form-control" value="{{$vat_value}}" required="">
                                    @error('vat_value')
                                        <div class="alert alert-danger" role="alert">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
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