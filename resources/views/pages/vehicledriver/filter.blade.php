@extends('layout.master')
@section('content')
    <!-- Breadcubs Area Start Here -->
      <!-- Breadcubs Area Start Here -->
      <div class="dashboard-content-one">
        <!-- Breadcubs Area Start Here -->
        <!-- <div class="breadcrumbs-area">
            
                <a href="{{ route('home') }}" title="Home">Home</a> /
                <a href="{{ route('vehicledriver.entry') }}" title="Course">VEHICLE & DRIVER MAPPING RECORDS</a>
            
        </div> -->
    
<div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">VEHICLE & DRIVER MAPPING RECORDS
                    <a href=# class="btn btn-primary" data-toggle="modal" data-target="#standard-modal">
                        <i class="fa fa-plus-circle fw-fa"></i> Add New
                    </a>
                </h3>
                {{-- <h1 class="page-header">List of Vehicle</h1> --}}
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
                <form action="{{ route('vehicledriver.filtering') }}" method="POST">
                @csrf
                        <div class="col col-lg-7 col-xl-5 form-group">
                        <div class="input-group">
                                        <select name="vehicleid" id="vehicleid" class="form-control" required>
                                            <option value="">Select Vehicle</option>
                                            @foreach ($vehicles as $vehicle)
                                                <option value="{{ $vehicle->id }}">
                                                    {{ $vehicle->item_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                <span class="input-group-append">


                                <button type="submit" class="btn btn-primary" name="Search" value="Search">
                                    <i class="fa fa-search"></i>&nbsp; Search</button>
                                </span>
                        </div>
        
                        </div> 
      
                </form>

<br>




                <!-- Modal -->
                <div class="modal fade" id="standard-modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add New Vehicle Driver</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('vehicledriver.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">

                                    <div class="col-md-12">
                                        <label for="vehicleid">Vehcile</label>
                                        <select name="vehicleid" id="vehicleid" class="form-control" required>
                                            <option value="">Select Vehcile</option>
                                            @foreach ($vehicles as $vehicle)
                                                <option value="{{ $vehicle->id }}">
                                                    {{ $vehicle->item_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                     </div>

                                     <div class="col-md-12">
                                        <label for="driverid">Driver</label>
                                        <select class="form-control" id="driverid" name="driverid"
                                            class="form-control" required>
                                            <option value="">Select Driver</option>
                                            <option value="1">Md Raju </option>
                                            <option value="2">Md Saju Mia</option>
                                            <option value="3">Md Shahin mia </option>
                                            <option value="4">Md Masum howlader </option>
                                        </select>
                                    </div>


<br>

                                        <div class="row">


                                        <div class="col-md-6">
                                                    <label for="initiate">Duration From</label>
                                                    <input type="date" id="initiate" class="form-control mb-3" placeholder="Enter Duration From"
                                                        name="initiate" >
                                                    </div>
                                        <div class="col-md-6">
                                                    <label for="expired">Duration To</label>
                                                    <input type="date" id="expired" class="form-control mb-3" placeholder="Enter Duration To"
                                                        name="expired">
                                        </div>
                                        

                                        </div>
               
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
                    <th>Vehicle Name</th>
                    <th>Driver Name</th>
                    <th>Duration From</th>
                    <th>Duration To</th>
           
                  
                    <th width="5%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                    <td>{{  $loop->index+1 }} </td>
               
                        <td>{{ $item->vehicle_name }}</td>
                        <td>{{ $item->driver_name }}</td>
                        <td>
                        {{ \Carbon\Carbon::parse($item->duration_from)->format('d-m-Y')}}
                       

                        </td>
                        <td>
                        {{ \Carbon\Carbon::parse($item->duration_to)->format('d-m-Y')}}
                           
                        
                        </td>
                       

                   
                    
                        <td> 
                       

                        <div class="nav">
                            <a title="Edit" href="" class="btn btn-primary btn-xs nav-link mr-3" data-toggle="modal"
                                    data-target="#edit-modal{{ $item->id }}"><i class="fa fa-edit"></i> </a>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="edit-modal{{ $item->id }}" tabindex="-1" role="dialog"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Vehicle Driver Mapping</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('vehicledriver.update', $item->id) }}" method="POST">
                                                @csrf
                                                <div class="col-md-12">
                                                    <label for="vehicleid">Vehicle Name</label>
                                                    <select name="vehicleid" id="vehicleid"   class="form-control" required>
                                                        <option value="">Select Vehicle</option>
                                                        @foreach ($vehicles as $vehicle)
                                                            <option  value=" {{ $vehicle->id }}"
                                                                {{ $vehicle->id == $item->vehicle_id ? 'selected' : null }}>
                                                                {{ $vehicle->item_name  }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="driverid">Driver Name</label>
                                                    <select name="driverid" id="driverid"   class="form-control" required>
                                                        <option value="">Select Driver</option>
                                                        @foreach ($drivers as $driver)
                                                            <option  value=" {{ $driver->id }}"
                                                                {{ $driver->id == $item->vehicle_driver_id ? 'selected' : null }}>
                                                                {{ $driver->driver_name  }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
<br>
                                                <div class="row">


                                    <div class="col-md-6">
                                                <label for="initiate">Duration From</label>
                                                <input type="date" id="initiate" class="form-control mb-3" placeholder="Enter Duration From"
                                                    name="initiate" >
                                                </div>
                                    <div class="col-md-6">
                                                <label for="expired">Duration To</label>
                                                <input type="date" id="expired" class="form-control mb-3" placeholder="Enter Duration To"
                                                    name="expired">
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

