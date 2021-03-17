<?php

namespace App\Http\Controllers;
use DB;
use App\User;
use Storage;
use Illuminate\Http\Request;

class UserController extends Controller
{
   public function uploadAvatar(Request $request)
   {
      if($request-> hasFile('image')){
      	 $filename=$request->image->getClientOriginalName();
      	 $path = $request->image->store('images','public');
       auth()->user()->update(['name'=>'Mike','avatar'=> $filename]);
       $request->session()->flash('message', 'Image Uploaded Successfully');
            return redirect()->back();
      }
      $request->session()->flash('error', 'Image Uploaded Failed');
          return redirect()->back();
   }
}
