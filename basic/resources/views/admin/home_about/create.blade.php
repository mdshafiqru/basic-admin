@extends('admin.admin_master')

@section('admin')
    


<div class="col-md-12 col-12">
  <div class="card card-default">
    <div class="card-header card-header-border-bottom">
      <h2>Create Home About</h2>
    </div>
    <div class="card-body">
      <form action=" {{ route('store.homeabout') }} " method="POST" >
        @csrf
        <div class="form-group">
          <label for="exampleFormControlInput1">About Title</label>
          <input type="text" class="form-control" name="title" placeholder="Slide Title">
          @error('title')
            <span class="text-danger"> {{ $message }} </span>
          @enderror
        </div>

        <div class="form-group">
          <label for="exampleFormControlTextarea1">About Short Description</label>
          <textarea class="form-control" name="short_desc" rows="3"></textarea>
          @error('short_desc')
            <span class="text-danger"> {{ $message }} </span>
          @enderror
        </div>

        <div class="form-group">
          <label for="exampleFormControlTextarea1">About Long Description</label>
          <textarea class="form-control" name="long_desc" rows="3"></textarea>
          @error('long_desc')
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