<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Page;
use App\Models\Message;
use App\Mail\ContactMail;
use Carbon\Carbon;
use Session;
use Mail;

class WebsiteController extends Controller{

    public function __construct(){
        
      }
    
    public function index(){
      $allPosts=Post::with('creator_info','editor_info')->where('post_status',1)->where('approve_status',1)->orderBy('updated_at','DESC')->take(5)->get();
      $featuredPost=Post::with('creator_info','editor_info')->where('post_status',1)->where('approve_status',1)->orderBy('view_count','DESC')->take(2)->get();
      return view('frontend.index',compact('allPosts','featuredPost'));
    }

    public function about(){
      $about=Page::where('page_id',1)->firstOrFail();
      return view('frontend.about',compact('about'));
    }

    public function contact(){
      $contact=Page::where('page_id',2)->firstOrFail();
      return view('frontend.contact',compact('contact'));
    }

    // public function contactmessage(Request $request){
    //   $this->validate($request,[
    //     'name'=> 'required|max:100|min:7|',
    //     'email'=> 'required',
    //     'message'=>'required|max:250|min:10',
    //   ],[
    //     'name.required'=> 'Please enter your name.',
    //     'email.required'=> 'Please enter your email.',
    //     'message.required'=> 'Please enter your message.',
    //   ]);
    //   $insert=Message::insert([
    //     'name'=>$request['name'],
    //     'email'=>$request['email'],
    //     'phone'=>$request['phone'],
    //     'message'=>$request['message'],
    //     'created_at'=>Carbon::now()->toDateTimeString(),
    //   ]);
    //   // $name=$request['name'];
    //   // $email=$request['email'];
      
    //   if($insert){
    //     Session::flash('success','Sucsessfully sent message. We will notify you soon.');
    //     // Mail::to($email)->send(new ContactMail($name));
    //     return redirect()->back();
    //   }else{
    //     Session::flash('error','OOPS Please try again !');
    //     return redirect()->back();
    //   }
    // }

    public function contactmessage(Request $request){
      $this->validate($request,[
            'name'=> 'required|max:100|min:7|',
            'email'=> 'required',
            'message'=>'required|max:250|min:10',
          ],[
            'name.required'=> 'Please enter your name.',
            'email.required'=> 'Please enter your email.',
            'message.required'=> 'Please enter your message.',
          ]);
      $insert=Message::insert([
            'name'=>$request['name'],
            'email'=>$request['email'],
            'phone'=>$request['phone'],
            'message'=>$request['message'],
            'created_at'=>Carbon::now()->toDateTimeString(),
      ]);
      if($insert){
        #Display Success Message in Blade File
        $arr = array('msg' => 'Your query has been submitted Successfully, we will contact you soon!', 'status' => true);
        return Response()->json($arr);
      }else{
        #Display fail Message in Blade File
        $arr = array('msg' => 'Your query has not been submitted Successfully, we will contact you soon!', 'status' => true);
        return Response()->json($arr);
      }
    }

    public function privacy(){
      $privacy=Page::where('page_id',3)->firstOrFail();
      return view('frontend.privacy',compact('privacy'));
    }

    public function post($slug){
      $post=Post::with('creator_info','editor_info','postCategory','tags')->where('post_slug',$slug)->where('post_status',1)->firstOrFail();
      $blogKey='blog_'.$post->post_id;
      if(!Session::has($blogKey)){
        $post->increment('view_count');
        Session::put($blogKey,1);
      }
      return view('frontend.post',compact('post'));
    }

    public function category($slug){
      $category=Category::with('creator_info','editor_info')->where('cat_slug',$slug)->firstOrFail();
      if($category){
        $posts=Post::with('creator_info','editor_info')->where('cat_id',$category->cat_id)->where('approve_status',1)->where('post_status',1)->orderBy('updated_at','DESC')->paginate(5);
        return view('frontend.category',compact('category','posts'));
      }else {
        return redirect()->back();
      } 
    }

    public function tag($slug){
      $tag=Tag::with('creator_info','editor_info')->where('tag_slug',$slug)->firstOrFail();
      if($tag){
        $posts=$tag->posts()->with('creator_info','editor_info')->orderBy('created_at','DESC')->where('post_status',1)->where('approve_status',1)->orderBy('updated_at','DESC')->paginate(5);
        return view('frontend.tag',compact('tag','posts'));
      }else {
        return redirect()->back();
      } 
    }

    public function search(){
      $q=$_GET['search'];
      $query=Post::with('creator_info','editor_info')->where('approve_status',1)->where('post_title','LIKE','%'.$q.'%')->orderBy('updated_at','DESC')->paginate(5);
      $query->appends(['search'=> $q]);
      return view('frontend.search',compact('query'));
    }

}
