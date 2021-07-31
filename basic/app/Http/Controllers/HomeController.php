<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Image;
use Auth;
use Illuminate\Support\Carbon;


class HomeController extends Controller
{

  public function __construct(){
    $this->middleware('auth');
  }


  // View All Slider section 
  public function HomeSlider(){
    $sliders = Slider::latest()->get();
    return view('admin.slider.index', compact('sliders'));
  }

  // Add Slider 
  public function AddSlider(){
    return view('admin.slider.create');
  }

  // Store Sliders
  public function StoreSlider(Request $request){
    $validated = $request->validate([
      'title'  => 'required|max:60',
      'image' => 'required|mimes:jpg,jpeg,png',
      ]);

    $slider_image = $request->file('image');

    $name_gen    = hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();
    Image::make($slider_image)->resize(1920,1088)->save('image/slider/'.$name_gen);

    $last_img = 'image/slider/'.$name_gen;

    Slider::insert([
      'title'  => $request->title,
      'description'  => $request->description,
      'image' => $last_img,
      'created_at'  => Carbon::now()
    ]);
    
    return Redirect()->route('home.slider')->with('success', 'Slide Added Successfully');

  }

  // Edit Slider 
  public function editSlider($id){
    $slider = Slider::find($id);
    return view('admin.slider.update', compact('slider'));
    
  }

  // Update Slider 
  public function UpdateSlider(Request $request, $id){
    $validated = $request->validate([
      'title'  => 'required|max:60',
      'image' => 'mimes:jpg,jpeg,png',
      ]);

    $old_image = $request->old_image;

    $slider_image = $request->file('image');

    if($slider_image){
      $name_gen    = hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();
      Image::make($slider_image)->resize(1920,1088)->save('image/slider/'.$name_gen);
  
      $last_img = 'image/slider/'.$name_gen;
      unlink($old_image);
      Slider::find($id)->update([
          'title'  => $request->title,
          'description'  => $request->description,
          'image' => $last_img,
        ]);

      return Redirect()->route('home.slider')->with('success', 'Slide Updated Successfully');

    } else{
      Slider::find($id)->update([
        'title'  => $request->title,
        'description'  => $request->description,
      ]);
      return Redirect()->route('home.slider')->with('success', 'Slide Updated Successfully');
    }
  }

  // Delete Slider 
  public function DeleteSlider($id){
    Slider::find($id)->delete();
    return Redirect()->back()->with('success', 'Slide Deleted Successfully');

  }


}
