@extends('layout.master')
@section('content')



    <div class="dashboard-content-one">
        <!-- Breadcubs Area Start Here -->
        <div class="breadcrumbs-area">
            <h3> Dashboard</h3>
<!--           
            <ul>
                <li>
                    <a href="#">Home</a>
                </li>

               
             
            </ul> -->
                <div class="p-3 mb-2 bg-light text-dark">    Welcome {{Auth::user()->name}} <br> </div>



 <!-- Dashboard summery Start Here -->
                <div class="row">
                    <div class="col-3-xxxl col-sm-6 col-12">
                        <div class="dashboard-summery-one">
                            <div class="row">
                                <div class="col-6">
                                    <div class="item-icon bg-light-red">
                                        <i class="flaticon-money text-red"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="item-content">
                                        <div class="item-title">Total Expense</div>

                                        <div class="item-number">
                                       
                                       00

                                             </div>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3-xxxl col-sm-6 col-12">
                        <div class="dashboard-summery-one">
                            <div class="row">
                                <div class="col-6">
                                    <div class="item-icon bg-light-magenta">
                                        <i class="flaticon-shopping-list text-magenta"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="item-content">
                                        <div class="item-title">Monthly Expense</div>
                                        <div class="item-number">
                                        
                                       00
                                        
                                    
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3-xxxl col-sm-6 col-12">
                        <div class="dashboard-summery-one">
                            <div class="row">
                                <div class="col-6">
                                    <div class="item-icon bg-light-yellow">
                                        <i class="flaticon-money text-green"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="item-content">
                                        <div class="item-title">Total Budget </div>
                                        <div class="item-number">
                                        
                                        00
                                        
                                    
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3-xxxl col-sm-6 col-12">
                        <div class="dashboard-summery-one">
                            <div class="row">
                                <div class="col-6">
                                    <div class="item-icon bg-light-blue">
                                        <i class="flaticon-money text-blue"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="item-content">
                                        <div class="item-title">Total Vehicle</div>
                                        <div class="item-number">
                                        
                                      5
                                        
                                    
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Dashboard summery End Here -->

                <table id="example" class="table table-bordered table-hover" cellspacing="0" style="font-size:12px">

            <thead class="bg-light">
            <tr>
                {{-- <th> Id</th> --}}
                <th>#</th>
                <th>Vehicle Name</th>
                <th>Total  Budget</th>
                <th>Total  Expense </th>
               
            
            </tr>
            </thead>
            <!--<tbody>-->
           
            <!--        <tr>-->
            <!--             <td> 1 </td>-->
            <!--            <td>Vehcile-1</td>-->
            <!--            <td>250000</td>-->
            <!--            <td>114000</td>            -->
            <!--        </tr>-->

            <!--        <tr></tr>-->
            <!--        <td> 2 </td>-->
            <!--            <td>Vehicle-2</td>-->
            <!--            <td>300000</td>-->
            <!--            <td>134000</td>  -->

            <!--        <tr>-->
            <!--        <td> 3 </td>-->
            <!--            <td>vehicle-3</td>-->
            <!--            <td>200000</td>-->
            <!--            <td>124000</td>  -->
            <!--        </tr>-->
            
            <!--</tbody>-->

        </table>

       
            @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    <strong>{{ $message }}</strong>
                                </div>
            @endif
        </div>
        <!-- Breadcubs Area End Here -->
        
    </div>

@endsection
