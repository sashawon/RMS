@extends('counter/layout')
@section('page_title','Add Item')
@section('item_select','active')

@section('container')

@if($id<0)
    @php
        $image_required = 'required'
    @endphp
@else
    @php
        $image_required = ''
    @endphp
@endif

<div class="col-12">
    <div class="overview-wrap">
        <h2 class="title-1">Add Item</h2>
    </div>
    <div class="overview-wrap m-t-30">
        <a class="btn btn-success" href="{{url('/counter/item')}}">BACK</a>
    </div>
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <div class="row m-t-30">
        <div class="col-12">
            @if(session()->has('sku_error'))
            <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                {{session('sku_error')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            @endif
        </div>
        <div class="col-12">
            @error('attr_image.*')
            <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                {{$message}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            @enderror
        </div>
        <div class="col-12">
            <form action="{{route('item.manage_item_process')}}" method="post" enctype= multipart/form-data>
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name" class="control-label mb-1">Food Name</label>
                            <input id="name" name="name" type="text" class="form-control" value="{{$name}}" required="">
                            @error('name')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="slug" class="control-label mb-1">Slug</label>
                                    <input id="slug" name="slug" type="text" class="form-control" value="{{$slug}}" required="">
                                    @error('slug')
                                        <div class="alert alert-danger" role="alert">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="category_id" class="control-label mb-1">Category</label>
                                    <select name="category_id" id="category_id" class="form-control" required="">
                                        <option value="">Select</option>
                                            @foreach($category as $list)
                                                @if($category_id==$list->id)
                                                    <option selected="" value="{{$list->id}}">{{$list->category_name}}</option>
                                                @else
                                                    <option value="{{$list->id}}">{{$list->category_name}}</option>
                                                @endif
                                            @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="alert alert-danger" role="alert">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="image" class="control-label mb-1">Image</label>
                            <input id="image" name="image" type="file" class="form-control" {{$image_required}}>
                            @error('image')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                            @enderror
                            <a href="{{asset('storage/item/'.$image)}}" target="_blank">
                                <img src="{{asset('storage/item/'.$image)}}" width="100px" alt="Item Image">
                            </a>
                        </div>
                        <div class="form-group">
                            <label for="component" class="control-label mb-1">Component</label>
                            <textarea id="component" name="component" rows="2" class="form-control" required="">{{$component}}</textarea>
                            @error('component')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="notes" class="control-label mb-1">Notes</label>
                            <textarea id="notes" name="notes" rows="2" class="form-control" required="">{{$notes}}</textarea>
                            @error('notes')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="desc" class="control-label mb-1">Description</label>
                            <textarea id="desc" name="desc" rows="2" class="form-control" required="">{{$desc}}</textarea>
                            @error('desc')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="overview-wrap pb-3">
                    <h2 class="title-1">Food Attributes</h2>
                </div>
                <div id="item_attr_box">
                    @php
                        $loop_count_num = 1;
                    @endphp
                    @foreach($itemAttrArr as $key => $val)
                    @php
                        $loop_count_prev = $loop_count_num;
                        $iArr = (array)$val;
                    @endphp
                    <div class="card" id="item_attr_{{$loop_count_num++}}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="sku" class="control-label mb-1">SKU</label>
                                        <input id="sku" name="sku[]" type="text" class="form-control" value="{{$iArr['sku']}}" required="">
                                        @error('sku')
                                            <div class="alert alert-danger" role="alert">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="price" class="control-label mb-1">Price</label>
                                        <input id="price" name="price[]" type="text" class="form-control" value="{{$iArr['price']}}" required="">
                                        @error('price')
                                            <div class="alert alert-danger" role="alert">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="type" class="control-label mb-1">Type</label>
                                        <select name="type_id[]" id="type_id" class="form-control">
                                            <option value="">Select</option>
                                                @foreach($type as $list)
                                                    @if($iArr['type_id']==$list->id)
                                                        <option selected="" value="{{$list->id}}">{{$list->type_name}}</option>
                                                    @else
                                                        <option value="{{$list->id}}">{{$list->type_name}}</option>
                                                    @endif
                                                @endforeach
                                        </select>
                                        @error('type_id')
                                            <div class="alert alert-danger" role="alert">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="discount" class="control-label mb-1">Discount</label>
                                        <input id="discount" name="discount[]" type="number" class="form-control" value="{{$iArr['discount']}}">
                                        @error('discount')
                                            <div class="alert alert-danger" role="alert">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4" id="discount_type">
                                    <div class="form-group">
                                        <label for="discount_type" class="control-label mb-1">Discount Type</label>
                                        <select name="discount_type[]" id="discount_type" class="form-control">
                                            <option value="">Select</option>
                                            @if($iArr['discount_type']=='val')
                                                <option selected="" value="val">Value</option>
                                                <option value="per">Percentage</option>
                                            @elseif($iArr['discount_type']=='per')
                                                <option value="val">Value</option>
                                                <option selected="" value="per">Percentage</option>
                                            @else
                                                <option value="val">Value</option>
                                                <option value="per">Percentage</option>
                                            @endif
                                        </select>
                                        @error('discount_type')
                                            <div class="alert alert-danger" role="alert">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="type" class="control-label mb-1">Size</label>
                                        <select name="size_id[]" id="size_id" class="form-control">
                                            <option value="">Select</option>
                                                @foreach($size as $list)
                                                    @if($iArr['size_id']==$list->id)
                                                        <option selected="" value="{{$list->id}}">{{$list->size_name}}</option>
                                                    @else
                                                        <option value="{{$list->id}}">{{$list->size_name}}</option>
                                                    @endif
                                                @endforeach
                                        </select>
                                        @error('size_id')
                                            <div class="alert alert-danger" role="alert">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="attr_image" class="control-label mb-1">Image</label>
                                        <input id="attr_image" name="attr_image[]" type="file" class="form-control" >
                                        @if($iArr['attr_image']!='')
                                        <a href="{{asset('storage/item_attr/'.$iArr['attr_image'])}}" target="_blank">
                                            <img src="{{asset('storage/item_attr/'.$iArr['attr_image'])}}" width="100px" alt="Item Image">
                                        </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="add" class="control-label mb-1"></label>
                                        
                                        @if($loop_count_num==2)
                                            <button id="payment-button" type="button" class="btn btn-lg btn-success btn-block" onclick="add_more()">
                                                <i class="fa fa-plus"></i>
                                                Add
                                            </button>
                                        @else
                                            <a class="btn btn-lg btn-danger btn-block" href="{{url('/counter/item/item_attr_delete')}}/{{$iArr['id']}}/{{$id}}">
                                                <i class="fa fa-minus"></i>
                                                Remove
                                            </a>
                                        @endif
                                        
                                    </div>
                                </div>
                                <input type="hidden" name="itaid[]" value="{{$iArr['id']}}">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div>
                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                        Submit
                    </button>
                </div>
                <input type="hidden" name="id" value="{{$id}}"/>
            </form>
        </div>
    </div>
</div>

<script>
    var loop_count=1;
    function add_more(){
        loop_count++;
        var html='<div class="card" id="item_attr_'+loop_count+'"><div class="card-body"><div class="row">';

        html+='<div class="col-4"><div class="form-group"><label for="sku" class="control-label mb-1">SKU</label><input id="sku" name="sku[]" type="text" class="form-control" value="" required=""></div></div>';

        html+='<div class="col-4"><div class="form-group"><label for="price" class="control-label mb-1">Price</label><input id="price" name="price[]" type="text" class="form-control" value="" required=""></div></div>';

        var type_id_html=jQuery('#type_id').html();
        type_id_html = type_id_html.replace("selected", "");
        html+='<div class="col-4"><div class="form-group"><label for="type" class="control-label mb-1">Type</label><select name="type_id[]" id="type_id" class="form-control">'+type_id_html+'</select></div></div>';

        html+='<div class="col-4"><div class="form-group"><label for="discount" class="control-label mb-1">Discount</label><input id="discount" name="discount[]" type="number" class="form-control" value=""></div></div>';

        var discount_type=jQuery('#discount_type').html();
        discount_type = discount_type.replace("selected", "");
        html+='<div class="col-4" id="discount_type"><div class="form-group"><label for="discount_type" class="control-label mb-1">Discount Type</label><select name="discount_type[]" id="discount_type" class="form-control"><option value="">Select</option><option value="val">Value</option><option value="per">Percentage</option></select></div></div>';
        
        var size_id_html=jQuery('#size_id').html();
        size_id_html = size_id_html.replace("selected", "");
        html+='<div class="col-4"><div class="form-group"><label for="size_id" class="control-label mb-1">Size</label><select name="size_id[]" id="size_id" class="form-control">'+size_id_html+'</select></div></div>';

        html+='<div class="col-4"><div class="form-group"><label for="attr_image" class="control-label mb-1">Image</label><input id="attr_image" name="attr_image[]" type="file" class="form-control"></div></div>';

        html+='<div class="col-2"><div class="form-group"><label for="add" class="control-label mb-1"></label><button id="payment-button" type="button" class="btn btn-lg btn-danger btn-block" onclick=remove_more("'+loop_count+'")><i class="fa fa-minus"></i>Remove</button></div></div>';
        
        html+='<input type="hidden" name="itaid[]"></div></div></div>';

        jQuery('#item_attr_box').append(html)
    }

    function remove_more(loop_count) {
        jQuery('#item_attr_'+loop_count).remove();
    }

    

    CKEDITOR.replace('component');
    CKEDITOR.replace('notes');
    CKEDITOR.replace('desc');
</script>
@endsection