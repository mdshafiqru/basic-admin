@extends('admin.admin_master')

@section('admin')
    


<div class="col-md-12 col-12">
  <div class="card card-default">
    <div class="card-header card-header-border-bottom">
      <h2>Create New Slide</h2>
    </div>
    <div class="card-body">
      <form action=" {{ route('store.slider') }} " method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="exampleFormControlInput1">Slide Title</label>
          <input type="text" class="form-control" name="title" placeholder="Slide Title">
          @error('title')
            <span class="text-danger"> {{ $message }} </span>
          @enderror
        </div>

        <div class="form-group">
          <label for="exampleFormControlTextarea1">Description</label>
          <textarea class="form-control" name="description" rows="3"></textarea>
        </div>
        <div class="form-group">
          <label for="exampleFormControlFile1">Slide Image <small>(dimention: 1920 x 1088 Pixel)</small> </label>
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