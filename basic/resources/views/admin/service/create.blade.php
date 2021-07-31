@extends('admin.admin_master')

@section('admin')
    


<div class="col-md-12 col-12">
  <div class="card card-default">
    <div class="card-header card-header-border-bottom">
      <h2>Create New Service</h2>
    </div>
    <div class="card-body">
      <form action=" {{ route('store.service') }} " method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="exampleFormControlInput1">Service Title</label>
          <input type="text" class="form-control" name="title" placeholder="Service Title">
          @error('title')
            <span class="text-danger"> {{ $message }} </span>
          @enderror
        </div>

        <div class="form-group">
          <label for="exampleFormControlInput1">Short Description </label>
          <input type="text" class="form-control" name="short_desc" placeholder="Short Description">
        </div>

        <div class="form-group">
          <label for="exampleFormControlFile1">Service Image <small>(dimention: 100 X 100 Pixel)</small> </label>
          <input type="file" class="form-control-file" name="image">
          @error('image')
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