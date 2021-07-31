<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Categories
           
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
          <div class="container">
            <div class="row">
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
                  <div class="card-header bg-primary text-white fw-bold">
                    All Category
                  </div>
                   <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col" class="text-center">SL No</th>
                    <th scope="col"> Category</th>
                    <th scope="col">User</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  {{-- @php($sl = 1) --}}
                  @foreach ($categories as $category)
                      
                  <tr>
                    <td class="text-center"> {{ $categories -> firstItem() + $loop -> index }} </td>
                    <td>
                      @if (strlen($category->category_name) >=25)
                      {{ substr($category->category_name, 0, 25) }} . . . 
                          
                      @else
                        {{ $category->category_name }}
                      @endif
                      
                    </td>
                    <td> {{ $category->user->name }} </td> 
                    {{-- <td> {{ $category->name }} </td>  --}}
                    <td> 

                      @if ($category->created_at == null)
                        <span class="text-danger"> No Date Set </span>
                      @else
                        {{-- {{ $category->created_at->diffForHumans() }} --}}
                        {{ Carbon\Carbon::parse($category->created_at)->diffForHumans() }}
                      @endif

                    </td>
                    <td class="d-flex flex-row justify-content-center ">
                      <a href="{{ url('category/edit/'.$category->id) }}" class="btn btn-info btn-sm me-2">Edit</a>
                      <a href="{{ url('softdelete/category/'.$category->id) }}" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                  </tr>
                  
                  @endforeach
                </tbody>
              </table>

              {{-- Paginattion --}}

              {{ $categories->links() }}

                </div>
              </div>

              <div class="col-md-4">
                <div class="card border-primary">
                  <div class="card-header bg-primary text-white "> Add New Category </div>

                  <div class="card-body">
                    <form action=" {{ route('store.category') }} " method="POST">
                      @csrf
                      <div class="form-group">
                        <label for="">Category Name</label>
                        <input type="text" name="category_name" class="form-control">

                        @error('category_name')
                          <span class="text-danger"> {{ $message }} </span>
                        @enderror

                      </div> <br>
                      <div >
                        <input type="submit" class="btn btn-primary text-white" value="Add Category">
                      </div>
                    </form>
                  </div>

                </div>
              </div>
             
            </div>
          </div>  

          {{-- trash category starts here  --}}
          <div class="container my-3">
            <div class="row">
              <div class="col-md-8">

                <div class="card border-danger">
                  <div class="card-header bg-danger text-white fw-bold">
                    Trashed Category List
                  </div>
                   <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col" class="text-center">SL No</th>
                    <th scope="col"> Category</th>
                    <th scope="col">User</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  {{-- @php($sl = 1) --}}
                  @foreach ($trashCat as $category)
                      
                  <tr>
                    <td class="text-center"> {{ $categories -> firstItem() + $loop -> index }} </td>
                    <td>
                      @if (strlen($category->category_name) >=25)
                      {{ substr($category->category_name, 0, 25) }} . . . 
                          
                      @else
                        {{ $category->category_name }}
                      @endif
                      
                    </td>
                    <td> {{ $category->user->name }} </td> 
                    {{-- <td> {{ $category->name }} </td>  --}}
                    <td> 

                      @if ($category->created_at == null)
                        <span class="text-danger"> No Date Set </span>
                      @else
                        {{-- {{ $category->created_at->diffForHumans() }} --}}
                        {{ Carbon\Carbon::parse($category->created_at)->diffForHumans() }}
                      @endif

                    </td>
                    <td>
                      <a href="{{ url('category/restore/'.$category->id) }}" class="btn btn-info btn-sm me-2">Restore</a>
                      <a href="{{ url('category/pdelete/'.$category->id) }}" onclick="return confirm('Are you sure you want to delete? This action can not be undone')" class="btn btn-danger btn-sm">Permanent Delete</a>
                    </td>
                  </tr>
                  
                  @endforeach
                </tbody>
              </table>

              {{-- Paginattion --}}

              {{ $categories->links() }}

                </div>
              </div>

             {{-- Trash category ends  here  --}}
             
            </div>
          </div>

        </div>
    </div>

    
</x-app-layout>
