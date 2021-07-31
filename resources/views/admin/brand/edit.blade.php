@extends('admin.admin_master')

@section('admin')
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
          <div class="container">
            <div class="row justify-content-center">

              <div class="col-md-8">

                @if (session('success'))
                {{-- <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong> {{ session('success') }} </strong>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div> --}}

                 <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong> {{ session('success') }} </strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                @endif

                <div class="card border-primary">
                  <div class="card-header bg-primary text-white "> Edit Brand </div>

                  <div class="card-body">
                    <form action=" {{ url('brand/update/'.$brands->id) }} " method="POST" enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" name="old_image" value="{{ $brands->brand_image }}">
                      <div class="form-group">
                        <label for="">Brand Name</label>
                        <input type="text" name="brand_name" value=" {{ $brands->brand_name }} " class="form-control">

                        @error('brand_name')
                          <span class="text-danger"> {{ $message }} </span>
                        @enderror
                      </div> <br>

                      <div class="form-group">
                        <label for="">Brand Image</label>
                        <input type="file" name="brand_image" value=" {{ $brands->brand_image }} " class="form-control">

                        @error('brand_image')
                          <span class="text-danger"> {{ $message }} </span>
                        @enderror
                      </div> <br>

                      <div class="form-group border-secondary">
                        <img src="{{ asset($brands->brand_image) }}" style="width: 400px; height: auto">
                      </div> <br>

                      <div >
                        <input type="submit" class="btn btn-primary text-white" value="Update Brand">
                        <a href="{{ route('all.brand') }}" class="btn btn-primary"> Go Back</a>
                      </div>
                      <div>
                      </div>
                    </form>
                  </div>

                </div>
              </div>
             
            </div>
          </div>

        </div>
    </div>
    
    @endsection