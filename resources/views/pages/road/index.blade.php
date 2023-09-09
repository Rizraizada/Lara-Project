@extends('layout.master_2')
@section('content')
    <!-- Breadcubs Area Start Here -->
    <div class="dashboard-content-one">
        <!-- Breadcubs Area Start Here -->
        <div class="breadcrumbs-area">
                
                    <a href="{{ route('home') }}" title="Home">Home</a> /
                    <a href="{{ route('road.entry') }}" title="Course">ROUTE ENTRY</a>
                
        </div>
    
        


        <div class="row">
            <div class="col-lg-12">
                <h6 class="page-header">VEHICLE ROUTE RECORDS
                    <a href=# class="btn btn-primary" data-toggle="modal" data-target="#standard-modal">
                        <i class="fa fa-plus-circle fw-fa"></i> Add New
                    </a>
                </h6>
                {{-- <h1 class="page-header">List of Routes</h1> --}}
                {{-- <button type="button" class="modal-trigger" data-toggle="modal" data-target="#standard-modal">
                    new
                </button> --}}

                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                @endif
                @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    <strong>{{ $message }}</strong>
                                </div>
                @endif
                @if ($message = Session::get('error'))
                                <div class="alert alert-danger">
                                    <strong>{{ $message }}</strong>
                                </div>
                             @endif
                <!-- Modal -->
                <div class="modal fade" id="standard-modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add New Route</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('road.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">


                                     <div class="col-md-12">
                                        <label for="road_name">Route Name</label>
                                        <input type="text" id="road_name" class="form-control mb-3" placeholder="Enter Route Name"
                                            name="road_name" required>
                                     </div>
                                     <div class="row">

                                    
                            
                               
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="footer-btn bg-linkedin"> Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <table id="example" class="table table-bordered table-hover" cellspacing="0" style="font-size:12px">

            <thead class="bg-light">
                <tr>
                    {{-- <th>Item Id</th> --}}
                    <th>#</th>
                    <th>Route Name</th>
                    
                 
                  
                    <th width="15%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roads as $road)
                    <tr>
                    <td>{{  $loop->index+1 }} </td>
                        <td>{{ $road->Road_name }}</td>
                
                       
                    
                        <td> 
                      

                        <div class="nav">
                            <a title="Edit" href="" class="btn btn-primary btn-xs nav-link mr-3" data-toggle="modal"
                                    data-target="#edit-modal{{ $road->id }}"><i class="fa fa-edit"></i> </a>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="edit-modal{{ $road->id }}" tabindex="-1" role="dialog"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Route Information</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('road.update', $road->id) }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="route_name">Route Name</label>
                                                        <input type="text" id="road_name" class="form-control" placeholder="Enter Route Name"
                                                            name="road_name" value="{{ $road->Road_name }}">
                                                    </div>

                                                
                                                    
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="footer-btn bg-linkedin"> Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                        </div>  
                        </td>
                    </tr>
                @endforeach

            </tbody>

        </table>
        
    </div>

  
@endsection

