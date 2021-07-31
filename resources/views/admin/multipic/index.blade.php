<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Multi Picture
           
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
          <div class="container">
            <div class="row">
              <div class="col-md-8">
                @if (session('success'))
                 <div class="alert alert-success alert-dismissible fade show" role="alert">
                   <strong> {{ session('success') }} </strong>
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>
                 @endif
                <div class="card border-primary">
                  <div class="card-header bg-primary text-white">
                    Multi Image
                  </div>
                  <div class="card-body">
                    <div class="card-group justify-content-center row gx-3">
                      @foreach ($images as $image)
                        <div class="col-md-4 col-6 m-2 mx-auto">
                          <div class="card">
                            <img src="{{ asset($image->image) }}" alt="">
                          </div>
                        </div>
                          
                      @endforeach
                    </div>
                  </div>
                </div>
                <div class="mt-3">
                  {{ $images->links() }}
                </div>
              </div>


              <div class="col-md-4">
                <div class="card border-primary">
                  <div class="card-header bg-primary text-white "> Multi Image </div>

                  <div class="card-body">
                    <form action=" {{ route('store.image') }} " method="POST" enctype="multipart/form-data">
                      @csrf

                      <div class="form-group">
                        <label for="">Image</label>
                        <input type="file" name="image[]" class="form-control" multiple>

                        @if (session('UploadError'))
                          <span class="text-danger"> {{ session('UploadError') }} </span>
                        @endif

                      </div> <br>
                      <div >
                        <input type="submit" class="btn btn-primary text-white" value="Add Image">
                      </div>
                    </form>
                  </div>

                </div>
              </div>
             
            </div>
          </div>  



        </div>
    </div>
</x-app-layout>
