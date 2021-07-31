<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Categories
           
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
          <div class="container">
            <div class="row justify-content-center">

              <div class="col-md-8">
                <div class="card border-primary">
                  <div class="card-header bg-primary text-white "> Update Category </div>

                  <div class="card-body">
                    <form action=" {{ url('category/update/'. $categories->id) }} " method="POST">
                      @csrf
                      <div class="form-group">
                        <label for="">Category Name</label>
                        <input type="text" name="category_name" value=" {{ $categories->category_name }} " class="form-control">

                        @error('category_name')
                          <span class="text-danger"> {{ $message }} </span>
                        @enderror

                      </div> <br>
                      <div >
                        <input type="submit" class="btn btn-primary text-white" value="Update Category">
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
