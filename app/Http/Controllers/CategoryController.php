<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Session;
use Auth;

class CategoryController extends Controller{
    public function __construct(){
      $this->middleware('auth');
    }

    public function index(){
      $allUser=Category::with('creator_info','editor_info')->where('cat_status',1)->orderBy('cat_name','DESC')->get();
      $i=1;
      return view('dashboard.category.all',compact('allUser','i'));
    }

    public function add(){
      return view('dashboard.category.add');
    }

     public function edit($slug){
       $data=Category::where('cat_slug',$slug)->where('cat_status',1)->firstOrFail();
       return view('dashboard.category.edit',compact('data'));
     }

     public function view($slug){
       $data=Category::with('creator_info','editor_info')->where('cat_slug',$slug)->where('cat_status',1)->firstOrFail();
       return view('dashboard.category.view',compact('data'));
     }

     public function insert(Request $request){
       $this->validate($request,[
       'name' => 'required|max:50|unique:categories,cat_name',
       'desc' => 'required',
     ],[
       'name.required'=>'Please Enter Category Name!',
       'desc.required'=>'Please Enter Category Description!',
     ]);
       $slug=Str::slug($request['name'],'-');
       $creator=Auth::user()->id;
       $insert=Category::insertGetId([
         'cat_name'=>$request['name'],
         'cat_description'=>$request['desc'],
         'cat_creator'=>$creator,
         'cat_slug'=>$slug,
         'created_at'=>Carbon::now()->toDateTimeString(),
       ]);

       if($insert){
         Session::flash('success','Successfully added category information!');
         return redirect('dashboard/categorys');
       }else{
         Session::flash('error','OOPS Please try again !');
         return redirect('dashboard/category/add');
       }
     }

     public function update(Request $request){
       $id=$request['id'];
       $this->validate($request,[
       'name' => 'required|max:50|unique:categories,cat_name,'.$id.',post_id',
       'desc' => 'required',
       ],[
       'name.required'=>'Please Enter Category Name!',
       'desc.required'=>'Please Enter Category Description!',
       ]);
       $slug=Str::slug($request['name'],'-');
       $editor=Auth::user()->id;
       $update=Category::where('cat_id',$id)->update([
         'cat_name'=>$request['name'],
         'cat_description'=>$request['desc'],
         'cat_editor'=>$editor,
         'cat_slug'=>$slug,
         'updated_at'=>Carbon::now()->toDateTimeString(),
       ]);

       if($update){
         Session::flash('success','Successfully updated category information!');
         return redirect('dashboard/category/view/'.$slug);
       }else{
         Session::flash('error','OOPS Please try again!');
         return redirect('dashboard/category/edit/'.$slug);
       }
     }

    public function softdelete(){
      $id=$_POST['modal_id'];
      $delete=Category::where('cat_id',$id)->where('cat_status',1)->update([
        'cat_status'=>'0',
      ]);
      if($delete){
        Session::flash('success','Successfully deleted category information!');
        return redirect('dashboard/categorys');
      }else{
        Session::flash('error','OOPS Please try again!');
        return redirect('dashboard/categorys');
      }
     }


     public function restore(){
       $id=$_POST['modal_id'];
       $delete=Category::where('cat_id',$id)->where('cat_status',0)->update([
         'cat_status'=>'1',
       ]);
       if($delete){
         Session::flash('success','Successfully restored category information!');
         return redirect('dashboard/categorys');
       }else{
         Session::flash('error','OOPS Please try again!');
         return redirect('dashboard/categorys');
       }
     }

     public function delete(){
       $id=$_POST['modal_id'];
       $delete=Category::where('cat_id',$id)->where('cat_status',0)->delete();
       if($delete){
         Session::flash('success','Permanently deleted category information!');
         return redirect('dashboard/categorys');
       }else{
         Session::flash('error','OOPS Please try again!');
         return redirect('dashboard/categorys');
       }
     }

}
