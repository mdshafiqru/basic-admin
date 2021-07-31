<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Auth;
use Image;

class UserController extends Controller
{
    

  public function Logout(){
    Auth::logout();
    return Redirect()->route('login')->with('success', 'You Have Logged Out Successfully');
  }

  // Change pass page
  public function AdminChangePass(){
    return view('admin.body.change_pass');
  }

  // Update Password for admin
  public function AdminUpdatePass(Request $request){
    $validated = $request->validate([
      'oldpassword'  => 'required',
      'password' => 'required|confirmed'
      ]);

      $hashedPass = Auth::user()->password;
      $oldpass = $request->oldpassword;

      if(Hash::check($oldpass, $hashedPass)){
        $user = User::find(Auth::id());
        $user->password = Hash::make($request->password);
        $user->save();
        Auth::logout();
        return Redirect()->route('login')->with('success', 'Password Changed Successfully');

      } else{
        return Redirect()->back()->with('error', 'Current Password is invalid');
      }
  }

  // Admin profile update
  public function AdminProfileUpdate(){
    if(Auth::user()){
      $user = User::find(Auth::user()->id);
      if($user){
        return view('admin.body.update_profile', compact('user'));
      }
    }

  }

  // Store profile update informations
  public function StoreAdminProfileUpdate(Request $request){
     if(Auth::user()){
      User::find(Auth::id())->update([
        'name'    => $request->name,
        'email'    => $request->email

      ]);
    
        return Redirect()->route('admin.profile.update')->with('success', 'Profile Updated Successfully');

      
    }   

      
    
  }



}