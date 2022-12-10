<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use Session;
use Auth;

class RecycleController extends Controller{
    public function __construct(){
      $this->middleware('auth');
      $this->middleware('admin');
    }

    public function index(){
      $reCatCount=Category::where('cat_status',0)->count();
      $reTagCount=Tag::where('tag_status',0)->count();
      $rePostCount=Post::where('post_status',0)->count();
      return view('dashboard.recycle.recycle',compact('reCatCount','reTagCount','rePostCount'));
    }

    public function category(){
      $allUser=Category::with('creator_info','editor_info')->where('cat_status',0)->orderBy('cat_name','DESC')->get();
      $i=1;
      return view('dashboard.recycle.category',compact('allUser','i'));
    }

    public function tag(){
      $allUser=tag::with('creator_info','editor_info')->where('tag_status',0)->orderBy('tag_name','DESC')->get();
      $i=1;
      return view('dashboard.recycle.tag',compact('allUser','i'));
    }

    public function post(){
      $allUser=Post::with('creator_info','editor_info')->where('post_status',0)->orderBy('post_title','DESC')->get();
      $i=1;
      return view('dashboard.recycle.post',compact('allUser','i'));
    }

}
