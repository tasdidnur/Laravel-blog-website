<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Session;
use Image;
use Auth;
use DB;

class PostController extends Controller{
  public function __construct(){
    $this->middleware('auth');
  }

  public function index(){
    $allUser=Post::with('creator_info','editor_info')->where('post_status',1)->orderBy('post_title','DESC')->get();
    $i=1;
    return view('dashboard.post.all',compact('allUser','i'));
  }

  public function add(){
    $tags=Tag::where('tag_status',1)->get();
    $categories=Category::where('cat_status',1)->get();
    return view('dashboard.post.add',compact('categories','tags'));
  }

   public function edit($slug){
     $data=Post::where('post_slug',$slug)->where('post_status',1)->firstOrFail();
     $categories=Category::where('cat_status',1)->get();
     $tags=Tag::where('tag_status',1)->get();
     return view('dashboard.post.edit',compact('data','categories','tags'));
   }

   public function view($slug){
     $data=Post::with('creator_info','editor_info','postCategory','tags')->where('post_slug',$slug)->where('post_status',1)->firstOrFail();
     return view('dashboard.post.view',compact('data'));
   }

   public function insert(Request $request){
     $this->validate($request,[
     'title' => 'required|unique:posts,post_title',
     'desc' => 'required',
     'category' => 'required',
   ],[
     'title.required'=>'Please Enter Post Title!',
     'desc.required'=>'Please Enter Post Description!',
     'category.required'=>'Please Enter Post Category!',
   ]);
     $slug=Str::slug($request['title'],'-');
     $creator=Auth::user()->id;
     $insert=Post::insertGetId([
       'post_title'=>$request['title'],
       'post_description'=>$request['desc'],
       'cat_id'=>$request['category'],
       'post_creator'=>$creator,
       'post_slug'=>$slug,
       'created_at'=>Carbon::now()->toDateTimeString(),
     ]);
     Post::find($insert)->tags()->attach($request->tags);

     if($request->hasFile('image')){
       $image=$request->file('image');
       $imageName='post'.$insert.time().'.'.$image->getClientOriginalExtension();
       Image::make($image)->save('uploads/posts/'.$imageName);

       Post::where('post_id',$insert)->update([
         'post_image'=>$imageName,
       ]);
     }

     if($insert){
       Session::flash('success','Successfully added post information!');
       return redirect('dashboard/post/add');
     }else{
       Session::flash('error','OOPS Please try again !');
       return redirect('dashboard/post/add');
     }
   }

   public function update(Request $request){
     $id=$request['id'];
     $this->validate($request,[
     'title' => 'required|unique:posts,post_title,'.$id.',post_id',
     'desc' => 'required',
     'category' => 'required',
    ],[
     'title.required'=>'Please Enter Post Title!',
     'desc.required'=>'Please Enter Post Description!',
     'category.required'=>'Please Enter Post Category!',
    ]);
     $slug=Str::slug($request['title'],'-');
     $editor=Auth::user()->id;
     $update=Post::where('post_id',$id)->update([
       'post_title'=>$request['title'],
       'post_description'=>$request['desc'],
       'cat_id'=>$request['category'],
       'post_editor'=>$editor,
       'post_slug'=>$slug,
       'updated_at'=>Carbon::now()->toDateTimeString(),
     ]);
     Post::find($id)->tags()->sync($request->tags);

     if($request->hasFile('image')){
       $image=$request->file('image');
       $imageName='post'.$id.time().'.'.$image->getClientOriginalExtension();
       Image::make($image)->save('uploads/posts/'.$imageName);

       Post::where('post_id',$id)->update([
         'post_image'=>$imageName,
       ]);
     }

     if($update){
       Session::flash('success','Successfully updated tag information!');
       return redirect('dashboard/post/view/'.$slug);
     }else{
       Session::flash('error','OOPS Please try again!');
       return redirect('dashboard/post/edit/'.$slug);
     }
   }

   public function status($slug){
    $id=Post::where('post_slug',$slug)->firstOrFail();
    $editor=Auth::user()->id;
    if($id->approve_status==0){
     $val=1;
    }else{
     $val=0;
    }
    $stat=Post::where('post_slug',$slug)->update([
      'approve_status'=>$val,
      'post_editor'=>$editor,
    ]);
    if($stat){
      return redirect()->back();
    }
   }

  public function softdelete(){
    $id=$_POST['modal_id'];
    $delete=Post::where('post_id',$id)->where('post_status',1)->update([
      'post_status'=>'0',
    ]);
    if($delete){
      Session::flash('success','Successfully deleted tag information!');
      return redirect('dashboard/posts');
    }else{
      Session::flash('error','OOPS Please try again!');
      return redirect('dashboard/posts');
    }
   }


   public function restore(){
     $id=$_POST['modal_id'];
     $delete=Post::where('post_id',$id)->where('post_status',0)->update([
       'post_status'=>'1',
     ]);
     if($delete){
       Session::flash('success','Successfully restored post information!');
       return redirect('dashboard/posts');
     }else{
       Session::flash('error','OOPS Please try again!');
       return redirect('dashboard/posts');
     }
   }

   public function delete(){
     $id=$_POST['modal_id'];
     $delete=Post::where('post_id',$id)->where('post_status',0)->delete();
     DB::table('post_tag')->where('post_id', $id)->delete();
     if($delete){
       Session::flash('success','Permanently deleted post information!');
       return redirect('dashboard/posts');
     }else{
       Session::flash('error','OOPS Please try again!');
       return redirect('dashboard/posts');
     }
   }

}
