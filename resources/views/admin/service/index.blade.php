@extends('admin.admin_master')

@section('admin')
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
          <div class="container">
            <div class="row">
              <div class="mb-2 col-md-12 col-12 d-flex justify-content-between">
                <h3>Home Services</h3>
                <a href=" {{ route('add.service') }} " type="submit" class="btn btn-primary">Add New Service</a>
              </div>

              <div class="col-md-12 col-12">

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
                
                <div class="card">
                  <div class="card-header bg-primary text-white fw-bold">
                    All Services
                  </div>
                   <table class="table table-striped  ">
                  <thead>
                    <tr>
                      <th width='5%'  class="text-center">SL No</th>
                      <th width='15%'>Service Title</th>
                      <th width='35%'>Short Description</th>
                      <th width='5%'>Image</th>
                      <th width='10%' >&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @php($sl = 1)
                  @foreach ($services as $service)
                      
                  <tr>
                    <td class="text-center"> {{ $sl++ }} </td>
                    <td>
                      {{ $service->title }}

                    </td>

                    <td>
                      {{ $service->short_desc }}
                      
                    </td>

                    
                    
                    <td > <img src=" {{ asset($service->image) }} " alt="Brand image for {{$service->title}}" style="width: 50px; height:50px" > </td> 

                    <td >
                      <div class="d-flex flex-row justify-content-center">
                        <a href="{{ url('service/edit/'.$service->id) }}" class="mr-2 btn btn-info btn-sm me-2">Edit</a>
                        <a href="{{ url('service/delete/'.$service->id) }}" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger btn-sm">Delete</a>
                      </div>
                    </td>
                  </tr>
                  
                  @endforeach
                </tbody>

              </table>

                      

                </div>
              </div>

            </div>
          </div>  



        </div>
    </div>

    @endsection