<?php

namespace App\Http\Controllers;

use App\Models\Counter\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['data'] = Item::all();
        return view('/counter/item',$result);
    }

    public function status(Request $request, $status, $id)
    {
        $model = Item::find($id);
        $model->status = $status;
        $model->save();
        session()->flash('msg','Item Status Update Successfully');
        return redirect('/counter/item');
    }
    
    public function manage_item(Request $request, $id='')
    {
        if ($id>0) {
            $arr = Item::where(['id'=>$id])->get();

            $result['id'] = $arr['0']->id;
            $result['name'] = $arr['0']->name;
            $result['slug'] = $arr['0']->slug;
            $result['category_id'] = $arr['0']->category_id;
            $result['image'] = $arr['0']->image;
            $result['component'] = $arr['0']->component;
            $result['notes'] = $arr['0']->notes;
            $result['desc'] = $arr['0']->desc;
            $result['status'] = $arr['0']->status;

            $result['itemAttrArr']=DB::table('items_attr')->where(['item_id'=>$id])->get();

        } else {
            $result['id'] = 0;
            $result['name'] = '';
            $result['slug'] = '';
            $result['category_id'] = '';
            $result['image'] = '';
            $result['component'] = '';
            $result['notes'] = '';
            $result['desc'] = '';
            $result['status'] = '';

            $result['itemAttrArr'][0]['id'] = '';
            $result['itemAttrArr'][0]['item_id'] = '';
            $result['itemAttrArr'][0]['sku'] = '';
            $result['itemAttrArr'][0]['price'] = '';
            $result['itemAttrArr'][0]['type_id'] = '';
            $result['itemAttrArr'][0]['discount'] = '';
            $result['itemAttrArr'][0]['discount_type'] = '';
            $result['itemAttrArr'][0]['size_id'] = '';
            $result['itemAttrArr'][0]['attr_image'] = '';
        }

        $result['category']=DB::table('categories')->where(['status'=>1])->get();
        $result['size']=DB::table('sizes')->where(['status'=>1])->get();
        $result['type']=DB::table('types')->where(['status'=>1])->get();
        
        return view('counter/manage_item',$result);

    }

    public function manage_item_process(Request $request)
    {
        //return $request->post(); 
        //echo "<pre>";
        //print_r($request->post());
        //die();

        if ($request->post('id')>0) {
            $image_validate = 'mimes:jpeg,jpg,png';
        } else {
            $image_validate = 'required|mimes:jpeg,jpg,png';
        }

        $request->validate([
            'name'=>'required',
            'image'=>$image_validate,
            'slug'=>'required|unique:items,slug,'.$request->post('id'),
            'attr_image.*'=>'mimes:jpeg,jpg,png'
        ]);

        if ($request->post('id')>0) {
            $model = Item::find($request->post('id'));
            $msg = 'Item Update Successfully';
        } else {
            $model = new Item();
            $msg = 'Item Add Successfully';
        }

        $itaidArr = $request->post('itaid');
        $skuArr = $request->post('sku');
        $priceArr = $request->post('price');
        $typeArr = $request->post('type_id');
        $discountArr = $request->post('discount');
        $discountTypeArr = $request->post('discount_type');
        $sizeArr = $request->post('size_id');

        foreach ($skuArr as $key => $value) {
            $check = DB::table('items_attr')->where('sku','=',$skuArr[$key])
                                            ->where('id','!=',$itaidArr[$key])->get();
            if (isset($check[0])) {
                $request->session()->flash('sku_error',$skuArr[$key].' SKU already used');
                return redirect(request()->headers->get('referer'));
            }
        }

        if ($request->hasfile('image')) {
            /*if ($request->post('id')>0) {
                $arrImage = DB::table('products')->where(['id'=>$request->post('id')])->get();
                if (Storage::exists('/public/item/'.$arrImage[0]->image)) {
                    Storage::delete('/public/item/'.$arrImage[0]->image);
                }
            }*/
            $image = $request->file('image');
            $ext = $image->extension();
            $image_name = time().'.'.$ext;
            $image->storeAs('public/item',$image_name);
            $model->image = $image_name;
        }

        $model->name = $request->post('name');
        $model->slug = $request->post('slug');
        $model->category_id = $request->post('category_id');
        //$model->image = $request->post('image');
        $model->component = $request->post('component');
        $model->notes = $request->post('notes');
        $model->desc = $request->post('desc');
        $model->status = 1;
        $model->save();
        $itid = $model->id;


        /* item Attr Start*/
        foreach ($skuArr as $key => $value) {
            $itemAttrArr=[];
            $itemAttrArr['item_id']=$itid;
            $itemAttrArr['sku']=$skuArr[$key];
            $itemAttrArr['price']=(int)$priceArr[$key];
            $itemAttrArr['type_id']=$typeArr[$key];
            $itemAttrArr['discount']=(int)$discountArr[$key];
            $itemAttrArr['discount_type']=$discountTypeArr[$key];
            $itemAttrArr['size_id']=$sizeArr[$key];

            
            //echo "<pre>";
            //print_r($itemAttrArr);
            //die();

            if ($request->hasFile("attr_image.$key")) {
                if ($itaidArr[$key]!='') {
                    $arrImage = DB::table('items_attr')->where(['id'=>$itaidArr[$key]])->get();
                    if (Storage::exists('/public/item_attr/'.$arrImage[0]->attr_image)) {
                        Storage::delete('/public/item_attr/'.$arrImage[0]->attr_image);
                    }
                }
                $rand = rand('111111111','999999999');
                $attr_image = $request->file("attr_image.$key");
                $ext = $attr_image->extension();
                $image_name = time().$rand.'.'.$ext;
                $request->file("attr_image.$key")->storeAs('public/item_attr',$image_name);
                $itemAttrArr['attr_image'] = $image_name;
            }
            
            
            if ($itaidArr[$key]!='') {
                DB::table('items_attr')->where(['id'=>$itaidArr[$key]])->update($itemAttrArr);
            } else {
                DB::table('items_attr')->insert($itemAttrArr);
            }
            
        }
        /* item Attr End*/

        session()->flash('msg',$msg);
        return redirect('/counter/item');

    }


    public function destroy(Request $request, $id)
    {
        $model = Item::find($id);
        $item_info = DB::table('items')
                    ->leftjoin('items_attr','items.id','items_attr.item_id')
                    ->where(['items.id'=>$model->id])
                    ->delete();
        // echo "<pre>";
        // print_r($item_info); 
        // die();
        // $model->delete();
        session()->flash('msg','Item Delete Successfully');
        return redirect('/counter/item');
    }

    public function item_attr_delete(Request $request, $itaid, $id)
    {
        $arrImage = DB::table('items_attr')->where(['id'=>$itaid])->get();
        if (Storage::exists('/public/item_attr/'.$arrImage[0]->attr_image)) {
            Storage::delete('/public/item_attr/'.$arrImage[0]->attr_image);
        }
        DB::table('items_attr')->where(['id'=>$itaid])->delete();
        return redirect('/counter/item/manage_item/'.$id);
    }
}
