<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Services;
use Image;
use Illuminate\Support\Carbon;


class ServiceController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
  }

  public function HomeService(){
    $services = Services::latest()->get();
    return view('admin.service.index', compact('services'));
  }

  // Add Home service
  public function AddHomeService(){
    return view('admin.service.create');

  }

  // Store Home Service 
  public function StoreHomeService(Request $request){
    $validated = $request->validate([
        'title'  => 'required|max:60',
        'image' => 'required|mimes:jpg,jpeg,png',
       ]);

        $service_image = $request->file('image');
        
        $name_gen    = hexdec(uniqid()).'.'.$service_image->getClientOriginalExtension();
        Image::make($service_image)->resize(100,100)->save('image/service/'.$name_gen);

        $last_img = 'image/service/'.$name_gen;

        Services::insert([
          'title'  => $request->title,
          'short_desc' => $request->short_desc,
          'image' => $last_img,
          'created_at'  => Carbon::now()
        ]);
        
        return Redirect()->route('home.service')->with('success', 'Service Added Successfully');
  }


  // Edit Service 
  public function EditService($id){
    $service = Services::find($id);
    return view('admin.service.edit', compact('service'));
  }

  // Update service
  public function UpdateService(Request $request, $id){
     $validated = $request->validate([
        'title'  => 'required|max:60',
        'image' => 'mimes:jpg,jpeg,png',
       ]);

        $old_image = $request->old_image;

        $service_image = $request->file('image');
        
        if($service_image){
          
          $name_gen = hexdec(uniqid()).'.'.$service_image->getClientOriginalExtension();
          Image::make($service_image)->resize(100,100)->save('image/service/'.$name_gen);
          
          $last_img = 'image/service/'.$name_gen;
          
          unlink($old_image);
          Services::find($id) -> update([
            'title'  => $request->title,
            'short_desc'  => $request->short_desc,
            'image' => $last_img
          ]);
          
          return Redirect()->route('home.service')->with('success', 'Service Updated Successfully');
        } 
        else{
          Services::find($id) -> update([
            'title'  => $request->title,
            'short_desc'  => $request->short_desc,
          ]);
        
          return Redirect()->route('home.service')->with('success', 'Service Updated Successfully');

        }
      }

      // Delete Service 
      public function DeleteService($id){
        $delete = Services::find($id)->delete();
        return Redirect()->route('home.service')->with('success', 'Service Deleted Successfully');
         
      }




}
