@extends('admin.admin_master')

@section('admin')
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
          <div class="container">
            <div class="row">
              <div class="col-md-8">

               
                
                <div class="card">
                  <div class="card-header bg-primary text-white fw-bold">
                    All Brands
                  </div>
                   <table class="table table-striped ">
                  <thead>
                    <tr>
                      <th scope="col" class="text-center">SL No</th>
                      <th scope="col"> Brand Name</th>
                      <th scope="col" class="text-center">Brand Image</th>
                      <th scope="col">Created At</th>
                      <th scope="col">&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; Action</th>
                    </tr>
                  </thead>
                  <tbody>

                  @foreach ($brands as $brand)
                      
                  <tr>
                    <td class="text-center"> {{ $brands -> firstItem() + $loop -> index }} </td>
                    <td>
                      @if (strlen($brand->brand_name) >=25)
                      {{ substr($brand->brand_name, 0, 25) }} . . . 
                          
                      @else
                        {{ $brand->brand_name }}
                      @endif
                      
                    </td>
                    <td > <img src=" {{ asset($brand->brand_image) }} " alt="Brand image for {{$brand->brand_name}}" style="height: 40px" class="mx-auto"> </td> 

                    <td> 

                      @if ($brand->created_at == null)
                        <span class="text-danger"> No Date Set </span>
                      @else
                        {{--  {{ $category->created_at->diffForHumans() }} --}}
                        {{ Carbon\Carbon::parse($brand->created_at)->diffForHumans() }}
                      @endif

                    </td>
                    <td >
                      <a href="{{ url('brand/edit/'.$brand->id) }}" class="btn btn-info btn-sm me-2">Edit</a>
                      <a href="{{ url('brand/delete/'.$brand->id) }}" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                  </tr>
                  
                  @endforeach
                </tbody>
              </table>

              {{-- Paginattion --}}

              {{ $brands->links() }}

                </div>
              </div>

              <div class="col-md-4">
                <div class="card border-primary">
                  <div class="card-header bg-primary text-white "> Add New Brand </div>

                  <div class="card-body">
                    <form action=" {{ route('store.brand') }} " method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                        <label for="">Brand Name</label>
                        <input type="text" name="brand_name" class="form-control">

                        @error('brand_name')
                          <span class="text-danger"> {{ $message }} </span>
                        @enderror

                      </div> <br>
                      <div class="form-group">
                        <label for="">Brand Image</label>
                        <input type="file" name="brand_image" class="form-control-file">

                        @error('brand_image')
                          <span class="text-danger"> {{ $message }} </span>
                        @enderror

                      </div> <br>
                      <div >
                        <input type="submit" class="btn btn-primary text-white" value="Add Brand">
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

<style>
  .w-5{
    display: none;
  }
  p {
    font-weight: 400;
    margin-bottom: 0;
    font-size: 0.98rem;
    line-height: 3.2 !important;
}
</style>