@extends('layout.master')
@section('content')
    <!-- Breadcubs Area Start Here -->
      <!-- Breadcubs Area Start Here -->
      <div class="dashboard-content-one">
        <!-- Breadcubs Area Start Here -->
        <!-- <div class="breadcrumbs-area">
            
                <a href="{{ route('home') }}" title="Home">Home</a> /
                <a href="{{ route('vehicledriver.entry') }}" title="Course">VEHICLE DETAILS</a>
            
        </div>
     -->
        <!-- <div class="row">
            <div class="col-lg-12">
                <h6 class="page-header">VEHICLE DETAILS
                  
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
                
            </div>
            <!-- /.col-lg-12
        </div> -->

        <div class="container mt-5 mb-5">
        <div class="row no-gutters">
            <div class="col-md-4 col-lg-4"><img
                    src="http://productreviewbd.com/wp-content/uploads/2016/08/Pajero-sport-productreviewbd-e1470736230734.jpg">
            </div>
            <div class="col-md-8 col-lg-8">
                <div class="d-flex flex-column">
                    <div class="d-flex flex-row justify-content-between align-items-center p-5 bg-dark text-white">
                        <h1 class="display-5 text-white">Dhaka Metro-Gha-18-1417</h1>
                    </div>
                    <div class="p-2 bg-black text-white">
                        <h3> Driver: Ariful Islam Razu (2018-continue)</h3>
                    </div>
                    <div class="d-flex flex-row text-white">
                        <div class="p-5 bg-primary text-center skill-block">
                            <h4>611 kilometer</h4>
                            <h6>October</h6>
                        </div>
                        <div class="p-5 bg-warning text-center skill-block">
                            <h4>2069 kilometer</h4>
                            <h6>September</h6>
                        </div>
                        <div class="p-5 bg-danger text-center skill-block">
                            <h4>2426 kilometer</h4>
                            <h6>August</h6>
                        </div>
                        <div class="p-5  bg-success text-center skill-block">
                            <h4>1387 kilometer</h4>
                            <h6>July</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">TAX Tokem Exp. Date</th>
                <th scope="col">Fitness Exp. Date</th>
                <th scope="col">Insurence Exp. Date</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">2/12/2022</th>
                <th>31/12/2022</th>
                <th>25/12/2022</th>
            </tr>

        </tbody>
    </table>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Sl No</th>
                <th scope="col">Date</th>
                <th scope="col">Oil/Litre</th>
                <th scope="col">Oil (Litre)</th>
                <th scope="col">Cost (TK)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>3</th>
                <th>12/10/2022</th>
                <th>109</th>
                <th>63</th>
                <th>6877</th>
            </tr>
            <tr>
                <th>2</th>
                <th>7/10/2022</th>
                <th>109</th>
                <th>55.05</th>
                <th>6000</th>
            </tr>
            <tr>
                <th>1</th>
                <th>1/10/2022</th>
                <th>109</th>
                <th>59.36</th>
                <th>6470</th>
            </tr>

        </tbody>
    </table>


<br>

        <table id="example" class="table table-bordered table-hover" cellspacing="0" style="font-size:12px">

            <thead class="bg-light">
                <tr>
                    {{-- <th>Item Id</th> --}}
                    <th>#</th>
                    <th>গাড়ির নাম </th>
                    <th>ড্রাইভার নাম </th>
                    <th>ব্যবহারকারীর নাম </th>
                    <th>ছাড়ার স্থান </th>
                    <th>গন্তব্য </th>
                    <th>ছাড়ার সময় </th>
                    <th>ফেরার সময় </th>
                    <th>মোট ঘণ্টা  </th>
                    <th>ব্যবহারের বিবরণ </th>
                    <th>প্রস্থান (কিঃমিঃ)</th>
                    <th>আগমন(কিঃমিঃ) </th>
                    <th>মিটার (রিডিং)</th>
                    <th>মন্তব্য </th>
        
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                    <td>{{  $loop->index+1}} </td>
                        <td>{{ "v-00001" }}</td>
                        <td>{{ "Ariful Islam Razu "}}</td>
                       <td></td>
                       <td></td>
                       <td></td>
                       <td></td>
                       <td></td>
                       <td></td>
                       <td></td>
                       <td></td>
                       <td></td>
                       <td></td>
                       <td></td>
                       
                    </tr>
                @endforeach

            </tbody>

        </table>
  
    </div>
@endsection

