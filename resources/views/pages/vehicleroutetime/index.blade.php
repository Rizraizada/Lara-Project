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
                <h6 class="page-header">VEHICLE ROUTE & TIME MAPPING RECORDS
                    <a href=# class="btn btn-primary" data-toggle="modal" data-target="#standard-modal">
                        <i class="fa fa-plus-circle fw-fa"></i> Add New
                    </a>
                </h6>
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
             





                <!-- Modal -->
                <div class="modal fade" id="standard-modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add New Vehicle Route& Time Map</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('vehicleroutetime.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">

                                    <div class="col-md-12">
                                        <label for="vehicleid">Vehcile Name</label>
                                        <select name="vehicleid" id="vehicleid" class="form-control" required>
                                            <option value="">Select Vehcile</option>
                                            @foreach ($vehicles as $vehicle)
                                                <option value="{{ $vehicle->id }}">
                                                    {{ $vehicle->item_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                     </div>

                         

                                    <div class="row">
                                    <div class="col-md-6">
                                        <label for="upstart">Up Trip start </label>
                                        <select name="upstart" id="upstart" class="form-control" required>
                                            <option value="">Select Route</option>
                                            @foreach ($routes as $road)
                                                <option value="{{ $road->Road_name }}">
                                                    {{ $road->Road_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                     </div>

                                     <div class="col-md-6">
                                        <label for="uptripend">Up Trip End </label>
                                        <select name="uptripend" id="uptripend" class="form-control" required>
                                            <option value="">Select Route</option>
                                            @foreach ($routes as $road)
                                                <option value="{{ $road->Road_name }}">
                                                    {{ $road->Road_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                     </div>
                          
                                     </div>



                                     <div class="row">
                                    <div class="col-md-6">
                                        <label for="upstart">Down Trip start </label>
                                        <select name="downstart" id="upstart" class="form-control" required>
                                            <option value="">Select Route</option>
                                            @foreach ($routes as $road)
                                                <option value="{{ $road->Road_name }}">
                                                    {{ $road->Road_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                     </div>

                                     <div class="col-md-6">
                                        <label for="uptripend">Down Trip End </label>
                                        <select name="downtripend" id="uptripend" class="form-control" required>
                                            <option value="">Select Route</option>
                                            @foreach ($routes as $road)
                                                <option value="{{ $road->Road_name }}">
                                                    {{ $road->Road_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                     </div>
                          
                                     </div>


<br>

                                        <div class="row">


                                        <div class="col-md-6">
                                                    <label for="initiatetime">Up Trip start Time</label>
                                                    <input type="time" id="initiatetime" class="form-control mb-3" placeholder="Enter Duration From"
                                                        name="initiatetime"  required>
                                                    </div>
                                        <div class="col-md-6">
                                                    <label for="reachtime">Up Trip  End Time </label>
                                                    <input type="time" id="reachtime" class="form-control mb-3" placeholder="Enter Duration To"
                                                        name="reachtime" required>
                                        </div>
                                        

                                        </div>


                                        <div class="row">


                            <div class="col-md-6">
                                        <label for="downinitiatetime">Down Trip start Time</label>
                                        <input type="time" id="downinitiatetime" class="form-control mb-3" placeholder="Enter Duration From"
                                            name="downinitiatetime"  required>
                                        </div>
                            <div class="col-md-6">
                                        <label for="downreachtime">Down Trip  End Time </label>
                                        <input type="time" id="downreachtime" class="form-control mb-3" placeholder="Enter Duration To"
                                            name="downreachtime" required>
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
                    <th style="font-family: 'SiyamRupali', sans-serif;"> Vehcile Name</th>
                   
                    <th style="font-family: 'SiyamRupali', sans-serif;">Up Trip start Time </th>
                    <th style="font-family: 'SiyamRupali', sans-serif;">Up Trip  End Time </th>
                    <th style="font-family: 'SiyamRupali', sans-serif;">Down strip start Time</th>
                    <th style="font-family: 'SiyamRupali', sans-serif;">Down strip end Time </th>
                    <th style="font-family: 'SiyamRupali', sans-serif;">Up Trip Start path </th>
                   
                   <th style="font-family: 'SiyamRupali', sans-serif;">Up Trip End path </th>
                   <!-- <th>গন্তব্য </th> -->
                   <th style="font-family: 'SiyamRupali', sans-serif;">Down strip start path </th>
                   <th style="font-family: 'SiyamRupali', sans-serif;">Down trip End path </th>

           
                  
                    <th width="5%">Action</th>
                </tr>
            </thead>
            <tbody>
               
            @foreach ($items as $item)
                    <tr>
                    <td>{{  $loop->index+1 }} </td>
                        <td>{{ $item->vehicle_name }}</td>
                    

                      <td> {{ \Carbon\Carbon::parse($item->up_trip_start_time)->format('g:i A')}} </td>
                      <td> {{ \Carbon\Carbon::parse($item->up_trip_end_time)->format('g:i A')}} </td>
                      <td> {{ \Carbon\Carbon::parse($item->down_trip_start_time)->format('g:i A')}} </td>
                      <td> {{ \Carbon\Carbon::parse($item->down_trip_end_time)->format('g:i A')}} </td>
                       <td>{{$item->up_trip_start}}</td>
                       <td>{{$item->up_trip_end}}</td>
                       <td>{{$item->down_trip_start}}</td>
                       <td>{{$item->down_trip_end}}</td>
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
                                                <h5 class="modal-title">Edit Vehicle Route Time Mapping</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('vehicleroutetime.update', $item->id) }}" method="POST">
                                                @csrf
                                                <div class="form-group">                
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
                        <div class="row">
                         <div class="col-md-6">
                            <label for="upstart">Up Trip start </label>
                            <select name="upstart" id="upstart" class="form-control" >
                                                            <option value="">Select Route</option>
                                    @foreach ($routes as $road)
                                 <option  value="{{ $road->Road_name }}"
                                     {{ $road->Road_name == $item->up_trip_start ? 'selected' : null }}>
                                    {{ $road->Road_name  }}
                                   </option>
                                    @endforeach
                            </select>
                        </div>

                                     <div class="col-md-6">
                                        <label for="uptripend">Up Trip End </label>
                                        <select name="uptripend" id="uptripend" class="form-control" >
                                                            <option value="">Select Route</option>
                                                            @foreach ($routes as $road)
                                                            <option  value=" {{ $road->Road_name }}"
                                                                            {{ $road->Road_name == $item->up_trip_end ? 'selected' : null }}>
                                                                            {{ $road->Road_name  }}
                                                                        </option>
                                                            @endforeach
                                                        </select>
                                     </div>
                          
                                     </div>



                                     <div class="row">
                                    <div class="col-md-6">
                                        <label for="downstart">Down Trip start </label>
                                        <select name="downstart" id="downstart" class="form-control" >
                                                            <option value="">Select Route</option>
                                                            @foreach ($routes as $road)
                                                            <option  value=" {{ $road->Road_name }}"
                                                                            {{ $road->Road_name == $item->down_trip_start ? 'selected' : null }}>
                                                                            {{ $road->Road_name  }}
                                                                        </option>
                                                            @endforeach
                                                        </select>
                                     </div>

                                     <div class="col-md-6">
                                        <label for="downend">Down Trip End </label>
                                        <select name="downend" id="downend" class="form-control" >
                                                            <option value="">Select Route</option>
                                                            @foreach ($routes as $road)
                                                            <option  value=" {{ $road->Road_name }}"
                                                                            {{ $road->Road_name == $item->down_trip_end ? 'selected' : null }}>
                                                                            {{ $road->Road_name  }}
                                                                        </option>
                                                            @endforeach
                                                        </select>
                                     </div>
                          
                                     </div>


                            <br>

                                        <div class="row">


                                        <div class="col-md-6">
                                                    <label for="initiatetime">Up Trip start Time</label>
                                                    <input type="time" id="initiatetime" class="form-control mb-3" placeholder="Enter Duration From"
                                                        name="initiatetime"  >
                                                    </div>
                                        <div class="col-md-6">
                                                    <label for="reachtime">Up Trip  End Time </label>
                                                    <input type="time" id="reachtime" class="form-control mb-3" placeholder="Enter Duration To"
                                                        name="reachtime" >
                                        </div>
                                        

                                        </div>


                                        <div class="row">


                                        <div class="col-md-6">
                                                    <label for="downinitiatetime">Down Trip start Time</label>
                                                    <input type="time" id="downinitiatetime" class="form-control mb-3" placeholder="Enter Duration From"
                                                        name="downinitiatetime"  >
                                                    </div>
                                        <div class="col-md-6">
                                                    <label for="downreachtime">Down Trip  End Time </label>
                                                    <input type="time" id="downreachtime" class="form-control mb-3" placeholder="Enter Duration To"
                                                        name="downreachtime" >
                                        </div>


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

