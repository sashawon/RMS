@extends('counter/layout')
@section('page_title','Add Coupon')
@section('coupon_select','active')

@section('container')
<div class="col-12">
    <div class="overview-wrap">
        <h2 class="title-1">Add Coupon</h2>
    </div>
    <div class="overview-wrap m-t-30">
        <a class="btn btn-success" href="{{url('/counter/coupon')}}">BACK</a>
    </div>
    <div class="row m-t-30">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('coupon.manage_coupon_process')}}" method="post" enctype= multipart/form-data>
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="title" class="control-label mb-1">Title</label>
                                    <input id="title" name="title" type="text" class="form-control" value="{{$title}}" required="">
                                    @error('title')
                                        <div class="alert alert-danger" role="alert">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="code" class="control-label mb-1">Code</label>
                                    <input id="code" name="code" type="text" class="form-control" value="{{$code}}" required="">
                                    @error('code')
                                        <div class="alert alert-danger" role="alert">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="value" class="control-label mb-1">Value</label>
                                    <input id="value" name="value" type="text" class="form-control" value="{{$value}}" required="">
                                    @error('value')
                                        <div class="alert alert-danger" role="alert">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="type" class="control-label mb-1">Type</label>
                                    <select name="type" id="type" class="form-control">
                                            @if($type=='value')
                                                <option selected value="value">Value</option>
                                                <option value="per">Percentage</option>
                                            @elseif($type=='per')
                                                <option value="value">Value</option>
                                                <option selected value="per">Percentage</option>
                                            @else
                                                <option value="value">Value</option>
                                                <option value="per">Percentage</option>
                                            @endif
                                    </select>
                                    @error('type')
                                        <div class="alert alert-danger" role="alert">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="min_ord_amt" class="control-label mb-1">Minimum Order Amount</label>
                                    <input id="min_ord_amt" name="min_ord_amt" type="text" class="form-control" value="{{$min_ord_amt}}">
                                    @error('min_ord_amt')
                                        <div class="alert alert-danger" role="alert">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="is_one_time" class="control-label mb-1">IS One Time</label>
                                    <select name="is_one_time" id="is_one_time" class="form-control">
                                            @if($is_one_time=='1')
                                                <option selected value="1">YES</option>
                                                <option value="0">NO</option>
                                            @else
                                                <option value="1">YES</option>
                                                <option selected value="0">NO</option>
                                            @endif
                                    </select>
                                    @error('is_one_time')
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