@extends('counter/layout')
@section('page_title','Update Order')
@section('totalorder_select','active')

@section('container')
<div class="col-12">
    <div class="overview-wrap">
        <h2 class="title-1">Update Order</h2>
    </div>
    <div class="overview-wrap m-t-30">
        <a class="btn btn-success" href="{{url('/counter/totalorder')}}">BACK</a>
    </div>
	<div class="row m-t-30">
	    <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('totalorder.manage_total_order_process')}}" method="post" enctype= multipart/form-data>
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="table_no" class="control-label mb-1">Table No</label>
                                    <select name="table_no" id="table_no" class="form-control" required="">
                                        @foreach($table as $list)
                                            @if($order_data[0]->table_id==$list->id)
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
                        </div>
                        <div>
                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                Submit
                            </button>
                        </div>
                        <input type="hidden" name="order_id" value="{{$order_data[0]->id}}">
                    </form>
                </div>
            </div>
        </div>
	</div>
</div>
@endsection