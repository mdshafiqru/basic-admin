<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Brand; 
use App\Models\Multipic; 
use Illuminate\Support\Carbon;
use Image;

class BrandController extends Controller
{

  public function __construct(){
    $this->middleware('auth');
  }

    public function AllBrand(){

      $brands = Brand::latest()->paginate(5);
      return view('admin.brand.index', compact('brands'));
    }

    // Store Brand
    public function storeBrand(Request $request){
      $validated = $request->validate([
        'brand_name'  => 'required|unique:brands|max:60',
        'brand_image' => 'required|mimes:jpg,jpeg,png',
       ]);

        $brand_image = $request->file('brand_image');

        // $name_gen    = hexdec(uniqid());
        // $img_ext     = strtolower($brand_image->getClientOriginalExtension());
        // $img_name    = $name_gen.'.'.$img_ext;
        // $up_location = 'image/brand/';
        // $last_img    = $up_location.$img_name;
        // $brand_image->move($up_location, $img_name);

        $name_gen    = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
        Image::make($brand_image)->resize(300,200)->save('image/brand/'.$name_gen);

        $last_img = 'image/brand/'.$name_gen;

        Brand::insert([
          'brand_name'  => $request->brand_name,
          'brand_image' => $last_img,
          'created_at'  => Carbon::now()
        ]);

        $notification = array(
          'message'     =>  'Brand Added Successfully!',
          'alert-type'  =>  'success'
        );
        
        // return Redirect()->back()->with('success', 'Brand Added Successfully');
        return Redirect()->back()->with($notification);

    }

    public function editBrand($id){
      $brands = Brand::find($id);
      return view('admin.brand.edit', compact('brands'));
    }

    // Update Brand 
    public function updateBrand(Request $request, $id){
        $validated = $request->validate([
        'brand_name'  => 'required|max:60',
        'brand_image' => 'mimes:jpg,jpeg,png',
       ]);

        $old_image = $request->old_image;

        $brand_image = $request->file('brand_image');
        
        if($brand_image){
          // $name_gen    = hexdec(uniqid());
          // $img_ext     = strtolower($brand_image->getClientOriginalExtension());
          // $img_name    = $name_gen.'.'.$img_ext;
          // $up_location = 'image/brand/';
          // $last_img    = $up_location.$img_name;

          // $brand_image->move($up_location, $img_name);

          
          $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
          Image::make($brand_image)->resize(300,200)->save('image/brand/'.$name_gen);
          
          $last_img = 'image/brand/'.$name_gen;
          
          unlink($old_image);
          Brand::find($id) -> update([
            'brand_name'  => $request->brand_name,
            'brand_image' => $last_img
          ]);
          
          return Redirect()->back()->with('success', 'Brand Updated Successfully');
        } 
        else{
          Brand::find($id) -> update([
            'brand_name'  => $request->brand_name,
          ]);
        
          return Redirect()->back()->with('success', 'Brand Updated Successfully');
        }
    }

    // Delete Brand

    public function deleteBrand($id){
      $image = Brand::find($id);
      $old_image = $image->brand_image;
      unlink($old_image);

      Brand::find($id)->delete();

      $notification = array([
        'message'     =>  'Brand Deleted Successfully',
        'alert-type'  =>  'error'
      ]);

      return Redirect()->back()->with($notification);

    } 
    // brand section ends here 

    // Multi Image section 

    public function MultiPic(){
      

      $images = Multipic::latest()->paginate(9);
      return view('admin.multipic.index', compact('images'));
    }

    public function storeMultiImg(Request $request){
      $validated = $request->validate([
        'image'  => 'required'
       ]);

      $allowedfileExtension=['jpeg','jpg','png'];

      $images = $request->file('image');

      if($images){
        foreach ($images as $image) {
          $extension = $image->getClientOriginalExtension();
  
          $check=in_array($extension,$allowedfileExtension);
          if($check){
            # code...
            $name_gen = hexdec(uniqid()).'.'.$extension;
            Image::make($image)->resize(300,300)->save('image/multi/'.$name_gen);
    
            $last_img = 'image/multi/'.$name_gen;
    
            Multipic::insert([
              'image' => $last_img,
              'created_at'  => Carbon::now()
            ]);
          } 
          else{
            return Redirect()->back()->with('UploadError', 'Only jpg, jpeg, png images are allowed.');
          }
  
        } // End of foreach loop

      }
      return Redirect()->back()->with('success', 'Images Added Successfully');
    }


}
