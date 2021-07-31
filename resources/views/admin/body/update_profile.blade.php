@extends('admin.admin_master')

@section('admin')

<div class="card card-default">
  @if (session('success'))
   <div class="alert alert-success alert-dismissible fade show" role="alert">
     <strong> {{ session('success') }} </strong>
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
   </div>
   @endif
  <div class="card-header card-header-border-bottom">


    <h2>Update Profile</h2>
  </div>
  <div class="card-body">
    <form action=" {{ route('store.profile.update') }} " method="POST" enctype="multipart/form-data" class="form-pill">
      @csrf
     
      <div class="form-group">
        <label for="">Name</label>
        <input name="name" type="text" class="form-control" value="{{ $user->name }}" >
      </div>

      <div class="form-group">
        <label for=""> Email </label>
        <input name="email" type="email" class="form-control" value="{{ $user->email }}" >
      </div>


      <div class="form-group">
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>
</div>


@endsection
