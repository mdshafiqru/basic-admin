<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomeAboutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PortfolioController;
use App\Models\User;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'prevent-back-history'],function(){
  



// Email verification 
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');




// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
  $brands = DB::table('brands')->get();
  $abouts = DB::table('home_abouts')->first();
  $services = DB::table('services')->get();
  return view('home', compact('brands', 'abouts', 'services'));
});

// Category Section 
Route::get('/about-us', [ContactController::class, 'index'])->name('about');
Route::get('/category/all', [CategoryController::class, 'AllCat'])->name('all.category');
Route::post('/category/add', [CategoryController::class, 'AddCat'])->name('store.category');
Route::get('/category/edit/{id}', [CategoryController::class, 'editCat']);
Route::post('/category/update/{id}', [CategoryController::class, 'updateCat']);
Route::get('/softdelete/category/{id}', [CategoryController::class, 'softDeleteCat']);
Route::get('/category/restore/{id}', [CategoryController::class, 'restoreCat']);
Route::get('/category/pdelete/{id}', [CategoryController::class, 'pDelete']);


// Brand Section
Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('all.brand');
Route::post('/brand/add', [BrandController::class, 'storeBrand'])->name('store.brand');
Route::get('/brand/edit/{id}', [BrandController::class, 'editBrand']);
Route::post('/brand/update/{id}', [BrandController::class, 'updateBrand']);
Route::get('/brand/delete/{id}', [BrandController::class, 'deleteBrand']);

// Multi image
Route::get('/multi/image/', [BrandController::class, 'MultiPic'])->name('multi.image');
Route::post('/multi/image/add', [BrandController::class, 'storeMultiImg'])->name('store.image');


// Admin Panel related Route section 

// Silder section
Route::get('/home/slider/', [HomeController::class, 'HomeSlider'])->name('home.slider');
Route::get('/home/slider/add', [HomeController::class, 'AddSlider'])->name('add.slider');
Route::post('/home/slider/store', [HomeController::class, 'StoreSlider'])->name('store.slider');
Route::get('/slider/edit/{id}', [HomeController::class, 'editSlider']);
Route::post('/slider/update/{id}', [HomeController::class, 'UpdateSlider']);
Route::get('/slider/delete/{id}', [HomeController::class, 'DeleteSlider']);

// Home About Section 
Route::get('/home/about/', [HomeAboutController::class, 'HomeAbout'])->name('home.about');
Route::get('/home/about/add', [HomeAboutController::class, 'AddAbout'])->name('add.about');
Route::post('/home/about/store', [HomeAboutController::class, 'StoreHomeAbout'])->name('store.homeabout');
Route::get('/home/about/edit/{id}', [HomeAboutController::class, 'EditAbout']);
Route::post('/home/about/update/{id}', [HomeAboutController::class, 'UpdateAbout']);
Route::get('/home/about/delete/{id}', [HomeAboutController::class, 'DeleteAbout']);

// Home Service Section 
Route::get('/home/service/', [ServiceController::class, 'HomeService'])->name('home.service');
Route::get('/home/service/add', [ServiceController::class, 'AddHomeService'])->name('add.service');
Route::post('/home/service/store', [ServiceController::class, 'StoreHomeService'])->name('store.service');
Route::get('/service/edit/{id}', [ServiceController::class, 'EditService']);
Route::post('/home/service/update/{id}', [ServiceController::class, 'UpdateService']);
Route::get('/service/delete/{id}', [ServiceController::class, 'DeleteService']);

// Portfolio Page section
Route::get('/portfolio/', [PortfolioController::class, 'Portfolio'])->name('portfolio');

// Admin contact route
Route::get('/admin/contact/', [ContactController::class, 'AdminContact'])->name('admin.contact');
Route::get('/admin/contact/add', [ContactController::class, 'AddContact'])->name('add.contact');
Route::post('/admin/contact/store', [ContactController::class, 'StoreContact'])->name('store.contact');
Route::get('/admin/contact/edit/{id}', [ContactController::class, 'EditContact']);
Route::post('/admin/contact/update/{id}', [ContactController::class, 'UpdateContact']);
Route::get('/admin/contact/delete/{id}', [ContactController::class, 'DeleteContact']);

// Admin Contact Message
Route::get('/admin/message/', [ContactController::class, 'AdminMessage'])->name('admin.message');
Route::get('/admin/message/delete/{id}', [ContactController::class, 'DeleteMessage']);



// Frontend Contact Route
Route::get('/contact/', [ContactController::class, 'Contact'])->name('contact');
Route::post('/contact/form', [ContactController::class, 'ContactForm'])->name('contact.form');




// Route::get('/contact', function () {
//     return view('contact');
// });



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    
  $users = User::all();
  // $users = DB::table('users')->get();

  return view('admin.index');
})->name('dashboard');

// Admin Profile and password update section 
Route::get('/admin/pass/change', [UserController::class, 'AdminChangePass'])->name('admin.change.pass');
Route::post('/admin/pass/update', [UserController::class, 'AdminUpdatePass'])->name('password.update');
// Admin Profile Update 
Route::get('/admin/profile/update', [UserController::class, 'AdminProfileUpdate'])->name('admin.profile.update');
Route::post('/admin/store/profile/update', [UserController::class, 'StoreAdminProfileUpdate'])->name('store.profile.update');

// Admin user logout 
Route::get('/user/logout/', [UserController::class, 'Logout'])->name('user.logout');






}); // Prevent Back History Middleware end here. You must make Routes before this line.
