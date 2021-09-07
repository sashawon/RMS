<?php

namespace App\Http\Controllers;

use App\Models\Counter\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $result['data'] = Category::all();
        return view('/counter/category',$result);
    }

    public function status(Request $request, $status, $id)
    {
        $model = Category::find($id);
        $model->status = $status;
        $model->save();
        session()->flash('msg','Category Status Update Successfully');
        return redirect('/counter/category');
    }

    public function manage_category(Request $request, $id='')
    {
        if ($id>0) {
            $arr = Category::where(['id'=>$id])->get();

            $result['id'] = $arr['0']->id;
            $result['category_name'] = $arr['0']->category_name;
            $result['category_slug'] = $arr['0']->category_slug;
            $result['parent_category_id'] = $arr['0']->parent_category_id;
            $result['is_home'] = $arr['0']->is_home;
            $result['is_home_selected'] = "";
            if ($arr['0']->is_home==1) {
                $result['is_home_selected'] = "checked";
            }
            $result['category']=DB::table('categories')->where(['status'=>1])->where('id','!=',$id)->get();
        } else {
            $result['id'] = 0;
            $result['category_name'] = '';
            $result['category_slug'] = '';
            $result['parent_category_id'] = '';
            $result['is_home'] = '';
            $result['is_home_selected'] = '';
            $result['category']=DB::table('categories')->where(['status'=>1])->get();
        }
        
        return view('/counter/manage_category',$result);
    }

    public function manage_category_process(Request $request)
    {
        $request->validate([
            'category_name'=>'required',
            'category_slug'=>'required|unique:categories,category_slug,'.$request->post('id')
        ]);

        if ($request->post('id')>0) {
            $model = Category::find($request->post('id'));
            $msg = 'Category Update Successfully';
        } else {
            $model = new Category();
            $msg = 'Category Added Successfully';
        }

                
        $model->category_name = $request->post('category_name');
        $model->category_slug = $request->post('category_slug');
        $model->parent_category_id = $request->post('parent_category_id');
        $model->is_home = 0;
        if ($request->post('is_home')!==null) {
            $model->is_home = 1;
        }
        $model->status = 1;
        $model->save();
        session()->flash('msg',$msg);
        return redirect('/counter/category');

    }
    
    public function destroy(Request $request, $id)
    {
        $model = Category::find($id);
        $model->delete();
        session()->flash('msg','Category Delete Successfully');
        return redirect('/counter/category');
    }
}
