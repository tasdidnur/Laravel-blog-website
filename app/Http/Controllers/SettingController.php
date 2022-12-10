<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Message;
use Carbon\Carbon;
use Session;
use Image;
use Auth;

class SettingController extends Controller{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index(){
        $data=Setting::where('setting_id',1)->firstOrFail();
        return view('dashboard.setting.index',compact('data'));
    }

    public function update(Request $request){
        $this->validate($request,[
            'facebook'=>'required',
            'twitter'=>'required',
            'instagram'=>'required',
            'youtube'=>'required',
            'pinterest'=>'required',
            'linkedin'=>'required',
            'copyright'=>'required',
        ],[
            'facebook.required'=>'Please enter your facebook link.',
            'twitter.required'=>'Please enter your twitter link.',
            'instagram.required'=>'Please enter your instagram link.',
            'youtube.required'=>'Please enter your youtube link.',
            'pinterest.required'=>'Please enter your pinterest link.',
            'linkedin.required'=>'Please enter your linkedin link.',
            'copyright.required'=>'Please enter your copyright link.',
        ]);
        $editor=Auth::user()->id;
        $update=Setting::where('setting_id',1)->update([
            'facebook'=>$request['facebook'],
            'twitter'=>$request['twitter'],
            'instagram'=>$request['instagram'],
            'youtube'=>$request['youtube'],
            'pinterest'=>$request['pinterest'],
            'linkedin'=>$request['linkedin'],
            'copyright'=>$request['copyright'],
            'editor'=>$editor,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);

        if($request->hasFile('dark_logo')){
            $image=$request->file('dark_logo');
            $imageName='dark_logo'.time().'.'.$image->getClientOriginalExtension();
            Image::make($image)->save('uploads/setting/'.$imageName);
            Setting::where('setting_id',1)->update([
              'dark_logo'=>$imageName,
            ]);
        }

        if($request->hasFile('light_logo')){
            $image=$request->file('light_logo');
            $imageName='light_logo'.time().'.'.$image->getClientOriginalExtension();
            Image::make($image)->save('uploads/setting/'.$imageName);
            Setting::where('setting_id',1)->update([
              'light_logo'=>$imageName,
            ]);
        }

        if($update){
            Session::flash('success','Successfully updated settings information!');
            return redirect('dashboard/setting');
        }else{
            Session::flash('error','oops please try again!');
            return redirect('dashboard/setting');
        }
    }

    public function message(){
        $message=Message::orderBy('created_at','DESC')->get();
        $i=1;
        return view('dashboard.setting.message',compact('message','i'));
    }

    public function messageview($slug){
        $data=Message::where('message_id',$slug)->firstOrFail();
        return view('dashboard.setting.messview',compact('data'));
    }

    public function deleteMessage(){
        $id=$_POST['modal_id'];
        $delete=Message::where('message_id',$id)->delete();
        if($delete){
        Session::flash('success','Permanently deleted message!');
        return redirect('dashboard/messeges');
        }else{
        Session::flash('error','OOPS Please try again!');
        return redirect()->back();
        }
   }
   

}
