@extends('admin.admin_master')

@section('admin')

<div class="card card-default">
  @if (session('error'))
   <div class="alert alert-danger alert-dismissible fade show" role="alert">
     <strong> {{ session('error') }} </strong>
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
   </div>
   @endif
  <div class="card-header card-header-border-bottom">


    <h2>Change Your Password</h2>
  </div>
  <div class="card-body">
    <form action=" {{ route('password.update') }} " method="POST" class="form-pill">
      @csrf
      <div class="form-group">
        <label for="exampleFormControlPassword3">Current Password</label>
        <input id="current_password" name="oldpassword" type="password" class="form-control" placeholder="Current Password">
        @error('oldpassword')
          <span class="text-danger"> {{ $message }} </span>
        @enderror
      </div>

      <div class="form-group">
        <label for="exampleFormControlPassword3">New Password</label>
        <input id="password" name="password" type="password" class="form-control" placeholder="New Password">
        @error('password')
          <span class="text-danger"> {{ $message }} </span>
        @enderror
      </div>

      <div class="form-group">
        <label for="exampleFormControlPassword3">Confirm New Password</label>
        <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" placeholder="Confirm New Password">
        @error('password_confirmation')
          <span class="text-danger"> {{ $message }} </span>
        @enderror
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>
</div>


@endsection
