<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Session;
use Auth;
use DB;

class TagController extends Controller{
  public function __construct(){
    $this->middleware('auth');
  }

  public function index(){
    $allUser=Tag::with('creator_info','editor_info')->where('tag_status',1)->orderBy('tag_name','DESC')->get();
    $i=1;
    return view('dashboard.tag.all',compact('allUser','i'));
  }

  public function add(){
    return view('dashboard.tag.add');
  }

   public function edit($slug){
     $data=Tag::where('tag_slug',$slug)->where('tag_status',1)->firstOrFail();
     return view('dashboard.tag.edit',compact('data'));
   }

   public function view($slug){
     $data=Tag::with('creator_info','editor_info')->where('tag_slug',$slug)->where('tag_status',1)->firstOrFail();
     return view('dashboard.tag.view',compact('data'));
   }

   public function insert(Request $request){
     $this->validate($request,[
     'name' => 'required|max:50|unique:tags,tag_name',
     'desc' => 'required',
   ],[
     'name.required'=>'Please Enter Tag Name!',
     'desc.required'=>'Please Enter Tag Description!',
   ]);
     $slug=Str::slug($request['name'],'-');
     $creator=Auth::user()->id;
     $insert=Tag::insertGetId([
       'tag_name'=>$request['name'],
       'tag_description'=>$request['desc'],
       'tag_creator'=>$creator,
       'tag_slug'=>$slug,
       'created_at'=>Carbon::now()->toDateTimeString(),
     ]);

     if($insert){
       Session::flash('success','Successfully added tag information!');
       return redirect('dashboard/tags');
     }else{
       Session::flash('error','OOPS Please try again !');
       return redirect('dashboard/tag/add');
     }
   }

   public function update(Request $request){
     $id=$request['id'];
     $this->validate($request,[
     'name' => 'required|max:50|unique:tags,tag_name,'.$id.',tag_id',
     'desc' => 'required',
     ],[
     'name.required'=>'Please Enter Tag Name!',
     'desc.required'=>'Please Enter Tag Description!',
     ]);
     $slug=Str::slug($request['name'],'-');
     $editor=Auth::user()->id;
     $update=Tag::where('tag_id',$id)->update([
       'tag_name'=>$request['name'],
       'tag_description'=>$request['desc'],
       'tag_editor'=>$editor,
       'tag_slug'=>$slug,
       'updated_at'=>Carbon::now()->toDateTimeString(),
     ]);

     if($update){
       Session::flash('success','Successfully updated tag information!');
       return redirect('dashboard/tag/view/'.$slug);
     }else{
       Session::flash('error','OOPS Please try again!');
       return redirect('dashboard/tag/edit/'.$slug);
     }
   }

  public function softdelete(){
    $id=$_POST['modal_id'];
    $delete=Tag::where('tag_id',$id)->where('tag_status',1)->update([
      'tag_status'=>'0',
    ]);
    if($delete){
      Session::flash('success','Successfully deleted tag information!');
      return redirect('dashboard/tags');
    }else{
      Session::flash('error','OOPS Please try again!');
      return redirect('dashboard/tags');
    }
   }


   public function restore(){
     $id=$_POST['modal_id'];
     $delete=Tag::where('tag_id',$id)->where('tag_status',0)->update([
       'tag_status'=>'1',
     ]);
     if($delete){
       Session::flash('success','Successfully restored tag information!');
       return redirect('dashboard/tags');
     }else{
       Session::flash('error','OOPS Please try again!');
       return redirect('dashboard/tags');
     }
   }

   public function delete(){
     $id=$_POST['modal_id'];
     $delete=Tag::where('tag_id',$id)->where('tag_status',0)->delete();
     DB::table('post_tag')->where('tag_id', $id)->delete();
     if($delete){
       Session::flash('success','Permanently deleted tag information!');
       return redirect('dashboard/tags');
     }else{
       Session::flash('error','OOPS Please try again!');
       return redirect('dashboard/tags');
     }
   }

}
