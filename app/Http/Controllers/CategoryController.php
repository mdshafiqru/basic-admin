<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class CategoryController extends Controller
{

      public function __construct(){
        $this->middleware('auth');
      }


    public function AllCat(){
      $categories = Category::latest()->paginate(10);

      $trashCat = Category::onlyTrashed()->latest()->paginate(3);

      // $categories  = DB::table('categories')
      //               ->join('users', 'categories.user_id', 'users.id')
      //               ->select('categories.*', 'users.name')
      //               ->latest() -> paginate(10);
      
      // $categories = DB::table('categories')->latest()->paginate(5); 

      return view('admin.category.index', compact('categories', 'trashCat')); 
    }

    public function AddCat(Request $request){
      $validated = $request->validate([
        'category_name' => 'required|unique:categories|max:60',
       ]);


      //  Eloquent ORM method 1 
      Category::insert([
        'category_name' => $request->category_name,
        'user_id'       => Auth::id(),
        'created_at'    => Carbon::now()
      ]);

      // Eloquent ORM method 2
      // $category = new Category;
      // $category->category_name = $request->category_name;
      // $category->user_id = Auth::id();
      // $category->save();

      // Query Builder method
      // $data = array();
      // $data['category_name']  = $request->category_name;
      // $data['user_id']        = Auth::id();
      // $data['created_at']     = Carbon::now();

      // DB::table('categories')->insert($data);

      return Redirect()-> back()-> with('success','Category Added Successfully');

    }


    public function editCat($id){
      // $categories = Category::find($id);

      $categories = DB::table('categories')->where('id', $id)->first();
      return view('admin.category.edit', compact('categories'));
    }


    public function updateCat(Request $request, $id){
      $categories = Category::find($id)->update([
        'category_name' => $request->category_name,
        'user_id'       => Auth::user()->id
      ]);

      // $data = array();
      // $data['category_name']  = $request->category_name;
      // $data['user_id']        = Auth::user()->id;
      
      // DB::table('categories')->where('id', $id)->update($data);

      return Redirect()-> route('all.category')-> with('success','Category Updated Successfully');

    }


    public function softDeleteCat($id){
      $delete = Category::find($id)->delete();
      return Redirect()-> back() -> with('success','Category Deleted Successfully');
    }

    public function restoreCat($id){
      $restore = Category::withTrashed()->find($id)->restore();
      return Redirect()-> back()-> with('success','Category Restored Successfully');
    }

    public function pDelete($id){
      $pdelete = Category::onlyTrashed()->find($id)->forceDelete();
      return Redirect()-> back()-> with('success','Category Permanently Deleted');

    }

}
