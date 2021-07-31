<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeAbout;
use Illuminate\Support\Carbon;


class HomeAboutController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
  }

  public function HomeAbout(){
    $homeabout = HomeAbout::latest()->get();
    return view('admin.home_about.index', compact('homeabout'));
  }

  // Add about info
  public function AddAbout(){
    return view('admin.home_about.create');
  }

  public function StoreHomeAbout(Request $request){
    $validated = $request->validate([
        'title' => 'required'
       ]);


      //  Eloquent ORM method 1 
      HomeAbout::insert([
        'title'       => $request->title,
        'short_desc'  => $request->short_desc,
        'long_desc'   => $request->long_desc,
        'created_at'  => Carbon::now()
      ]);
      return Redirect()-> route('home.about')-> with('success','About Info Added Successfully');
  }

  // Edit Home About
  public function EditAbout($id){
    $homeAboutData = HomeAbout::find($id);

    return view('admin.home_about.edit', compact('homeAboutData'));
  }

  // Update About
  public function UpdateAbout(Request $request, $id){

    $update = HomeAbout::find($id)->update([
        'title'       => $request->title,
        'short_desc'  => $request->short_desc,
        'long_desc'   => $request->long_desc,
      ]);
      return Redirect()-> route('home.about')-> with('success','About Info Updated Successfully');

  }

  // Delete About
  public function DeleteAbout($id){
    HomeAbout::find($id)->delete();
    return Redirect()-> route('home.about')-> with('success','About Info Deleted Successfully');

  }

}
