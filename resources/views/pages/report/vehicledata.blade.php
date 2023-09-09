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
                <h6 class="page-header">Report
                  
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
                <form action="{{ route('report.filter') }}" method="POST">
                @csrf
                        <div class="col-lg-12 form-group">
                        <div class="input-group">
                                        <!-- <select name="vehicleid" id="vehicleid" class="form-control" >
                                            <option value="">Select Vehicle</option>
                                            @foreach ($vehicles as $vehicle)
                                                <option value="{{ $vehicle->id }}" >
                                                    {{ $vehicle->item_name }}
                                                </option>
                                            @endforeach
                                        </select> -->
                                        &nbsp;&nbsp;

                                        <select id="yr" name="yr" class="form-control" required>
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
 <br>
        <form action="{{ route('report.details') }}" method="POST">
                @csrf

                <span class="input-group-append">
                 
              
                <input type="hidden" id="monid" name="monid" value=" <?php if(isset($_POST["monid"])){echo $_POST["monid"];} ?> ">
                <input type="hidden" id="yr" name="yr" value="<?php if(isset($_POST["yr"])){echo $_POST["yr"];} ?>">

                    <button type="submit" class="btn btn-primary"  targte="_blank"name="report" value="report">
                    <i class="fa fa-print"></i>&nbsp; Print Report</button>

                    
                    </span>
                                    
                
        </form> 




            </div>
            <!-- /.col-lg-12 -->
        </div>


    <div class="row">
        <div class="col-lg-12 btn btn-danger btn-block btn-lg" style="margin-bottom:10px;    line-height: 28px;
        height: 36px;"> Search Reasult For : Year - <?php    if(isset($_POST["yr"])){echo $_POST["yr"];} ?> 
        and Month: <?php  if(isset($_POST["monid"])){echo $_POST["monid"];} ?> </div>
           <br>
            <div class="col-lg-4" style="padding:0px">

            <table id="example"  class="table table-bordered table-hover" cellspacing="0" style="font-size:12px;width:100%">

                <thead class="thead-dark">
                    <tr>
                        {{-- <th>Item Id</th> --}}
                        <th>#</th>
                        <th>Vehcile Name </th>
                        <th width="40%">Total Distance(KM)</th>
                    
                    </tr>
                </thead>
                <tbody>
                    @foreach ($totaldistance as $distance)
                        <tr>
                        <td>{{$loop->index+1 }} </td>
                        <td>{{ $distance->vehicle_name }}</td>
                        <td>{{$distance->distance_covered}}</td>

                        </tr>
                    @endforeach

                </tbody>

                </table>
            </div>

        <div class="col-lg-3" style="padding:0px">
         <table id="example" class="table table-bordered table-hover" cellspacing="0" style="font-size:12px;width:100%">

                    <thead class="thead-dark">
                        <tr>
                            {{-- <th>Item Id</th> --}}
                            <!-- <th>#</th>
                            <th>Vehcile Name </th> -->
                            <th>Total Oil (Litre)</th>
                            <th>Total Gas (Litre)</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                 @foreach ($fuel_info_oil as $fuel)
                 <tr>
                                     <!-- <td>{{$loop->index+1 }} </td>   
                          
                                     <td>{{ $fuel->vehicle_name }}</td> -->
                             
                                     <td style="height:57px">
                                        @if($fuel->fuelType==1)
                                                            
                                         {{$fuel->total}}

                                         @else
                                          <td>0</td>
                                         @endif

                                     </td>                       

                                    @foreach ($fuel_info_gas as $subfuel)

                                            @if($subfuel->vehicleId==$fuel->vehicleId)
                                                
                                                        <td style="height:57px">
                                                           
                                                            @if($subfuel->fuelType==2)
                                                            {{$subfuel->total}}
                                                            @else
                                                            <td>0</td>
                                                            @endif
                                                        </td>

                                         
                                            @endif
                                    @endforeach

                </tr>
                       
                    @endforeach

                </tbody>

            </table>
        </div>

        <div class="col-lg-2" style="padding:0px">

            <table id="example" class="table table-bordered table-hover" cellspacing="0" style="font-size:12px;width:100%">

                <thead class="thead-dark">
                    <tr>
                        {{-- <th>Item Id</th> --}}
                        <!-- <th>#</th>
                        <th>Vehcile Name </th> -->
                        <th>Total Fuel Consumed</th>
                    
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fuel_info_all as $fuels)
                        <tr>
                        <!-- <td>{{$loop->index+1 }} </td>
                        <td>{{ $fuels->vehicle_name }}</td> -->
                        <td style="height:57px">{{$fuels->total}}</td>

                        </tr>
                    @endforeach

                </tbody>

                </table>
        </div>


        


         <div class="col-lg-3" style="padding:0px">
         <table id="example" class="table table-bordered table-hover" cellspacing="0" style="font-size:12px;width:100%">

                    <thead class="thead-dark">
                        <tr>
                            {{-- <th>Item Id</th> --}}
                             <!-- <th>#</th>
                             <th>Vehcile Name </th>  -->
                            <th> Distance Covered in km(Per Litre) </th>
                          
                        
                        </tr>
                    </thead>
                    <tbody>
                     @foreach ($totaldistance as $distance)
               
                                                       

                                    @foreach ($fuel_info_all as $subfuel)

                                            @if($subfuel->vehicleId==$distance->vehicle_id)
                                                
                                                       <tr>
                                                            <!-- <td>{{$loop->index+1 }} </td>
                                                             <td>{{ $subfuel->vehicle_name }}</td>  -->
                                                           <td style="height:57px">
                                                           @if($subfuel->total!=0)
                                                             {{ number_format($distance->distance_covered /  $subfuel->total,2)}}
                                                             @endif
                                                                               
                                                           </td> 
                                                          
                                                        </tr>

                                         
                                            @endif
                                    @endforeach

                       
                    @endforeach

                </tbody>

            </table>
        </div>

       
    </div>


    </div>
@endsection

