@extends('counter/layout')
@section('page_title','Add Category')
@section('category_select','active')

@section('container')
<div class="col-12">
    <div class="overview-wrap">
        <h2 class="title-1">Add Category</h2>
    </div>
    <div class="overview-wrap m-t-30">
        <a class="btn btn-success" href="{{url('/counter/category')}}">BACK</a>
    </div>
	<div class="row m-t-30">
	    <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('category.manage_category_process')}}" method="post" enctype= multipart/form-data>
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="category_name" class="control-label mb-1">Category</label>
                                    <input id="category_name" name="category_name" type="text" class="form-control" value="{{$category_name}}" required="">
                                    @error('category_name')
                                        <div class="alert alert-danger" role="alert">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="parent_category_id" class="control-label mb-1">Parent Category</label>
                                    <select name="parent_category_id" id="parent_category_id" class="form-control" required="">
                                        <option value="0">Select</option>
                                        @foreach($category as $list)
                                            @if($parent_category_id==$list->id)
                                                <option selected="" value="{{$list->id}}">{{$list->category_name}}</option>
                                            @else
                                                <option value="{{$list->id}}">{{$list->category_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('parent_category_id')
                                        <div class="alert alert-danger" role="alert">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="category_slug" class="control-label mb-1">Category Slug</label>
                                    <input id="category_slug" name="category_slug" type="text" class="form-control" value="{{$category_slug}}" required="">
                                    @error('category_slug')
                                        <div class="alert alert-danger" role="alert">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
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