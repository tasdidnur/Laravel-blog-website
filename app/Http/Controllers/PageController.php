<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Session;
use Image;
use Auth;

class PageController extends Controller{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function aboutUs(){
        $data=Page::where('page_id',1)->firstOrFail();
        return view('dashboard.pages.about',compact('data'));
    }

    public function contact(){
        $data=Page::where('page_id',2)->firstOrFail();
        return view('dashboard.pages.contact',compact('data'));
    }

    public function privacy(){
        $data=Page::where('page_id',3)->firstOrFail();
        return view('dashboard.pages.privacy',compact('data'));
    }

    public function update(Request $request){
        $id=$request['id'];
        $editor=Auth::user()->id;
        $update=Page::where('page_id',$id)->update([
            'page_title'=>$request['title'],
            'page_subtitle'=>$request['subtitle'],
            'page_description'=>$request['desc'],
            'page_editor'=>$editor,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);

        if($request->hasFile('image')){
            $image=$request->file('image');
            $imageName='page'.$id.time().'.'.$image->getClientOriginalExtension();
            Image::make($image)->save('uploads/pages/'.$imageName);
     
            Page::where('page_id',$id)->update([
              'back_image'=>$imageName,
            ]);
        }

        if($update){
            Session::flash('success','Successfully updated page information!');
            return redirect()->back();
        }else{
            Session::flash('success','Successfully updated page information!');
            return redirect()->back();
        }
    }

}
