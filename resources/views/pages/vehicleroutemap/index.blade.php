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
                <h6 class="page-header">VEHICLE & DRIVER MAPPING RECORDS
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
                <form action="{{ route('vehicleroutemap.filter') }}" method="POST">
                @csrf
                        <div class="col-lg-12  form-group">
                        <div class="input-group">
                                        <select name="vehicleid" id="vehicleid" class="form-control" required>
                                            <option value=""> Vehicle</option>
                                            @foreach ($vehicles as $vehicle)
                                                <option value="{{ $vehicle->id }}">
                                                    {{ $vehicle->item_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        
                                            &nbsp;&nbsp;

                                        <select id="yr" name="yr" class="form-control">
                                        <option>Select year</option>
                                    
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                    </select>
                                    &nbsp;&nbsp;
                                        <select placeholder="MM" name="monid" id="monid" class="form-control">
                                        <option value="">Select Month</option>
                                        <option name="" value="" style="display:none;">MM</option>
                                        <option name="January" value=01">January</option>
                                        <option name="February" value="02">February</option>
                                        <option name="March" value="03">March</option>
                                        <option name="April" value="04">April</option>
                                            <option name="May" value="05">May</option>
                                        <option name="June" value="06">June</option>
                                        <option name="July" value="07">July</option>
                                        <option name="August" value="08">August</option>
                                            <option name="September" value="09">September</option>
                                        <option name="October" value="10">October</option>
                                        <option name="November" value="11">November</option>
                                        <option name="December" value="12">December</option>
                                        </select>

                                <span class="input-group-append">


                                <button type="submit" class="btn btn-primary" name="Search" value="Search">
                                    <i class="fa fa-search"></i>&nbsp; Search</button>
                                </span>
                        </div>
        
                        </div> 
      
                </form>





                <!-- Modal -->
                <div class="modal fade" id="standard-modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add New Vehicle Route Map</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('vehicleroutemap.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">

                                    <div class="col-md-12">
                                        <label for="vehicleid">গাড়ির নাম</label>
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
                                        <label for="driverid">ড্রাইভার নাম</label>
                                        <select class="form-control" id="driverid" name="driverid"
                                            class="form-control" required>
                                            <option value="">Select Driver</option>
                                            <option value="1">Md Raju </option>
                                            <option value="2">Md Saju</option>
                                            <option value="3">Md Shahin </option>
                                            <option value="4">Md Masum howlader </option>
                                        </select>
                                    </div>


                                


<!-- 
                                    <div class="col-md-12">
                                        <label for="userid">ব্যবহারকারীর নাম</label>
                                        <select name="userid" id="userid" class="form-control" required>
                                            <option value="">Select User</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div> -->
                                    <div class="row">
                                    <div class="col-md-12">
                                        <label for="routeid">ছাড়ার স্থান </label>
                                        <select name="routeid" id="routeid" class="form-control" required>
                                            <option value="">Select Route</option>
                                            @foreach ($routes as $route)
                                                <option value="{{ $route->id }}">
                                                    {{ $route->Road_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                     </div>
                          
                                     </div>


<br>

                                        <div class="row">


                                        <div class="col-md-6">
                                                    <label for="initiatetime">ছাড়ার সময়</label>
                                                    <input type="datetime-local" id="initiatetime" class="form-control mb-3" placeholder="Enter Duration From"
                                                        name="initiatetime"  required>
                                                    </div>
                                        <div class="col-md-6">
                                                    <label for="reachtime">পৌছার সময় </label>
                                                    <input type="datetime-local" id="reachtime" class="form-control mb-3" placeholder="Enter Duration To"
                                                        name="reachtime" required>
                                        </div>
                                        

                                        </div>

                        <div class="row">


                            <div class="col-md-6">
                                                    <label for="initiatekm">প্রস্থান (কিঃমিঃ)</label>
                                                    <input type="text" id="initiatekm" class="form-control mb-3" placeholder="Enter data" name="initiatekm"  required>
                            </div>
                            <div class="col-md-6">
                                            <label for="reachkm">আগমন(কিঃমিঃ) </label>
                                    <input type="text" id="reachkm" class="form-control mb-3" placeholder="Enter data" name="reachkm" required>
                            </div>
                                        

                        </div>
                                     <div class="row">                  
                                        <div class="col-md-12">
                                            <div class="form-group">
                                            <label for="name">ব্যবহারকারীর নাম</label><br>
<!--<select id="userid" name="userid" class="form-control">-->

<!--                                        <option value="Employee">Employee</option>-->
<!--                                        <option value="Teacher">Teacher</option>-->
<!--                                        <option value="Accounce">Accounce</option>-->
<!--                                        <option value="Samsuddin Ahmed">Samsuddin Ahmed</option>-->
<!--                                        <option value="Nurjahan">Nurjahan</option>-->
<!--                                        <option value="Farzana Akter">Farzana Akter</option>-->
<!--                                        <option value="Md. Habibur Rahman">Md. Habibur Rahman</option>-->
<!--                                        <option value="Suman Saha">Suman Saha</option>-->
<!--                                        <option value="Md. Ashrafuzzaman">Md. Ashrafuzzaman</option>-->
<!--                                        <option value="Munira Akter Lata">Munira Akter Lata</option>-->
<!--                                        <option value="Farhana Islam">Farhana Islam</option>-->
<!--                                        <option value="Syeda Zakia Nayem">Syeda Zakia Nayem</option>-->
<!--                                        <option value="Muhammad Shahinul Kabir">Muhammad Shahinul Kabir</option>-->
<!--                                        <option value=" Md. Ashraf Uddin">Md. Ashraf Uddin</option>-->
<!--                                        <option value=" Kazi Abdullah Al Farhad">Kazi Abdullah Al Farhad</option>-->
<!--                                    </select>-->
                                            <textarea id="userid" name="userid"  rows="4" cols="50" ></textarea>
                                            </div>

                                        </div>
                                     </div>
                                     <!--<div class="col-md-12">-->
                                    
                                     <!--</div>-->
                                        <div class="col-md-12">
                                        <label for="use_desc">ব্যবহারের বিবরণ</label>
                                        <input type="text" id="use_desc" class="form-control mb-3" placeholder="Enter use description"
                                            name="use_desc" >
                                         </div>

                                         <div class="col-md-12">
                                        <label for="remarks">মন্তব্য</label>
                                        <input type="text" id="remarks" class="form-control mb-3" placeholder="Enter remarks"
                                            name="remarks" >
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
                    <th style="font-family: 'SiyamRupali', sans-serif;"> গাড়ির নাম </th>
                    <th style="font-family: 'SiyamRupali', sans-serif;">ড্রাইভার নাম </th>
                   
                    <th style="font-family: 'SiyamRupali', sans-serif;">ছাড়ার স্থান </th>
                    <!-- <th>গন্তব্য </th> -->
                    <th style="font-family: 'SiyamRupali', sans-serif;">ছাড়ার সময় </th>
                    <th style="font-family: 'SiyamRupali', sans-serif;">পৌছার সময় </th>
                    <th style="font-family: 'SiyamRupali', sans-serif;">ব্যবহারকারীর নাম </th>
                    <th style="font-family: 'SiyamRupali', sans-serif;">ব্যবহারের বিবরণ </th>
                    <th style="font-family: 'SiyamRupali', sans-serif;">প্রস্থান (কিঃমিঃ)</th>
                    <th style="font-family: 'SiyamRupali', sans-serif;">আগমন(কিঃমিঃ) </th>
                    <th style="font-family: 'SiyamRupali', sans-serif;">মোট (কিঃমিঃ) </th>
                    <th style="font-family: 'SiyamRupali', sans-serif;">মিটার </th>
                    <th style="font-family: 'SiyamRupali', sans-serif;">মন্তব্য </th>
                    <th style="font-family: 'SiyamRupali', sans-serif;">এন্ট্রি তারিখ </th>
                    <th style="font-family: 'SiyamRupali', sans-serif;">এন্ট্রি কারী   </th>
           
                  
                    <th width="5%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                    <td>{{ $items->firstItem() + $loop->index }} </td>
                        <td>{{ $item->vehicle_name }}</td>
                        <td>{{ $item->driver_name }}</td>
                       
                       <td>{{$item->Road_name}}</td>

                      <td> {{ \Carbon\Carbon::parse($item->period_from)->format('Y-m-d g:i A')}} </td>
                      <td> {{ \Carbon\Carbon::parse($item->period_to)->format('Y-m-d g:i A')}} </td>

                       <!-- <td>{{$item->period_from}}</td> -->
                       <!-- <td>{{$item->period_to}}</td> -->
                       <td>{{$item->username}}</td>
                       <td>{{$item->user_desc}}</td>
                       <td>{{$item->prosthan}}</td>
                       <td>{{$item->agomon}}</td>
                       <td>{{$item->agomon - $item->prosthan}}</td>
                       <td>{{$item->agomon}}</td>
                       <td>{{$item->remarks}}</td>
                       <td>{{$item->created_at}}</td>
                       <td>{{$item->created_by}}</td>
                 
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
                                               <h5 class="modal-title">Edit Vehicle Driver Route Mapping</h5>
                                               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                   <span aria-hidden="true">&times;</span>
                                               </button>
                                           </div>
                                <form action="{{ route('vehicleroutemap.update', $item->id) }}" method="POST">
                                    @csrf
                                     <div class="form-group">    
                                               <div class="col-md-12">
                                                   <label for="vehicleid">গাড়ির নাম</label>
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
                                                   <label for="driverid">ড্রাইভার নাম</label>
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
                                        
                                  

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label for="routeid">ছাড়ার স্থান </label>
                                                        <select name="routeid" id="routeid" class="form-control" required>
                                                            <option value="">Select Route</option>
                                                            @foreach ($routes as $route)
                                                            <option  value=" {{ $route->id }}"
                                                                            {{ $route->id == $item->start_from ? 'selected' : null }}>
                                                                            {{ $route->Road_name  }}
                                                                        </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                        
                                                </div>
                                                    <div class="row">


                                                        <div class="col-md-6">
                                                                    <label for="initiatetime">ছাড়ার সময়</label>
                                                                    <input type="datetime-local" id="initiatetime" class="form-control mb-3" placeholder="Enter Duration From"
                                                                        name="initiatetime"  >
                                                                    </div>
                                                        <div class="col-md-6">
                                                                    <label for="reachtime">পৌছার সময় </label>
                                                                    <input type="datetime-local" id="reachtime" class="form-control mb-3" placeholder="Enter Duration To"
                                                                        name="reachtime" >
                                                        </div>
                                                     </div>
                                                        <div class="row">


                                                         <div class="col-md-6">
                                                                <label for="initiatekm">প্রস্থান (কিঃমিঃ)</label>
                                                                <input type="text" id="initiatekm" class="form-control mb-3" 
                                                                placeholder="Enter data" name="initiatekm" value="{{$item->prosthan}}" >
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="reachkm">আগমন(কিঃমিঃ) </label>
                                                                    <input type="text" id="reachkm" class="form-control mb-3" 
                                                                    placeholder="Enter data" name="reachkm" value="{{$item->agomon}}">
                                                            </div>
                                                                

                                                      </div>

                                                      <div class="row">                  
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                            <label for="name">ব্যবহারকারীর নাম</label><br>

                                                            <textarea id="userid" name="userid"  rows="4" cols="50">{{$item->username}}</textarea>
                                                            </div>

                                                        </div>
                                                    </div>
                                                      <div class="col-md-12">
                                        <label for="use_desc">ব্যবহারের বিবরণ</label>
                                        <input type="text" id="use_desc" class="form-control mb-3" placeholder="Enter use description"
                                            name="use_desc"  value="{{$item->user_desc}}">
                                         </div>

                             </div>
                                               <div class="modal-footer">
                                                   <button type="submit" class="footer-btn bg-linkedin"> Update</button>
                                               </div>
                                           </form>
                                       </div>
                                   </div>
                               </div>
                            </td>
                    </tr>
                @endforeach

            </tbody>

        </table>
        <div class="d-felx justify-content-center">

{{ $items->links() }}

</div>
<p>
Displaying {{$items->count()}} of {{ $items->total() }} data(s).
</p>
    </div>
@endsection

