@extends('admin.admin_master')

@section('admin')
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
          <div class="container">
            <div class="row">
              <div class="mb-2 col-md-12 col-12 d-flex justify-content-between">
                <h3>Admin Messages</h3>
                
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
                    All Contact Messages 
                  </div>
                   <table class="table table-striped  ">
                  <thead>
                    <tr>
                      <th width='5%' class="text-center">SL No</th>
                      <th width='15%'>User Name</th>
                      <th width='10%'>Email</th>
                      <th width='15%'>Subject</th>
                      <th width='35%'>Message</th>
                      <th width='5%'>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @php($sl = 1)
                  @foreach ($messages as $message)
                      
                  <tr>
                    <td class="text-center"> {{ $sl++ }} </td>
                    <td> {{ $message->name }} </td>

                    <td> {{ $message->email }} </td>

                    <td> {{ $message->subject }} </td>

                    <td> {{ $message->message }} </td>
                    
                    <td >
                      <div class="d-flex flex-row justify-content-center">
                        <a href="{{ url('admin/message/delete/'.$message->id) }}" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger btn-sm">Delete</a>
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