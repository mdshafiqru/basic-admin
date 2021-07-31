<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Contact;
use App\Models\ContactForm;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
  }

  public function AdminContact(){
    $contacts = Contact::latest()->get();
    return view('admin.contact.index', compact('contacts'));
  }

  public function AddContact(){
    return view('admin.contact.create');
  }

  // Store contact info
  public function StoreContact(Request $request){
     $validated = $request->validate([
        'email' => 'required',
        'phone' => 'required',
        'address' => 'required',

       ]);


      //  Eloquent ORM method 1 
      Contact::insert([
        'email'       => $request->email,
        'phone'       => $request->phone,
        'address'     => $request->address,
        'created_at'  => Carbon::now()
      ]);
      return Redirect()-> route('admin.contact')-> with('success','Contact Info Added Successfully');
  }

  // Edit contact info
  public function EditContact($id){
    $contact = Contact::find($id);
    return view('admin.contact.edit', compact('contact'));
  }

  // Update Contact
  public function UpdateContact(Request $request, $id){
    $validated = $request->validate([
        'email' => 'required',
        'phone' => 'required',
        'address' => 'required',

       ]);


      //  Eloquent ORM method 1 
      Contact::find($id)->update([
        'email'       => $request->email,
        'phone'       => $request->phone,
        'address'     => $request->address,
      ]);
      return Redirect()-> route('admin.contact')-> with('success','Contact Updated Successfully');
  }

  // Delete Contact
  public function DeleteContact($id){
    Contact::find($id)->delete();
    return Redirect()-> route('admin.contact')-> with('success','Contact Delete Successfully');
    
  }

  // Frond end contact 
  public function Contact(){
    $contacts = DB::table('contacts')->first();
    return view('pages.contact', compact('contacts'));
  }

  // Contact Form

  public function ContactForm(Request $request){
    $validated = $request->validate([
      'name' => 'required',
      'email' => 'required',
      'subject' => 'required',
      'message' => 'required',

      ]);


    //  Eloquent ORM method 1 
    ContactForm::insert([
      'name'        => $request->name,
      'email'       => $request->email,
      'subject'     => $request->subject,
      'message'     => $request->message,
      'created_at'  => Carbon::now()
    ]);
    return Redirect()-> route('contact')-> with('success','Your message has been sent Successfully, We will be right back as soon as possible');

  }

  // Admin Message
  public function AdminMessage(){
    $messages = ContactForm::latest()->get();
    return view('admin.message.message', compact('messages'));
  }

  // Delte Admin Message
  public function DeleteMessage($id){
    ContactForm::find($id)->delete();
    return Redirect()-> route('admin.message')-> with('success','Message Deleted Succesfully!');

  }


}
