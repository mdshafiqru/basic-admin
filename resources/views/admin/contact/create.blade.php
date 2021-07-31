@extends('admin.admin_master')

@section('admin')
    


<div class="col-md-12 col-12">
  <div class="card card-default">
    <div class="card-header card-header-border-bottom">
      <h2>Create New Contact</h2>
    </div>
    <div class="card-body">
      <form action=" {{ route('store.contact') }} " method="POST" >
        @csrf
        <div class="form-group">
          <label for="exampleFormControlInput1">Contact Email</label>
          <input type="email" class="form-control" name="email" placeholder="Contact Email">
          @error('email')
            <span class="text-danger"> {{ $message }} </span>
          @enderror
        </div>

        <div class="form-group">
          <label for="exampleFormControlInput1">Contact Phone</label>
          <input type="text" class="form-control" name="phone" placeholder="Contact Phone">
          @error('phone')
            <span class="text-danger"> {{ $message }} </span>
          @enderror
        </div>

        <div class="form-group">
          <label for="exampleFormControlTextarea1">Contact Address</label>
          <textarea class="form-control" name="address" rows="3"></textarea>
          @error('address')
            <span class="text-danger"> {{ $message }} </span>
          @enderror
        </div>

       
        <div class="form-footer pt-4 pt-5 mt-4 border-top">
          <button type="submit" class="btn btn-primary btn-default">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>






@endsection