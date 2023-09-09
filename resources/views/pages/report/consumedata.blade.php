@extends('layout.master')
@section('content')

    <div class="dashboard-content-one">

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


                        <input type="hidden" id="monid" name="monid" value=" <?php if (isset($_POST['monid'])) {
                            echo $_POST['monid'];
                        } ?> ">
                        <input type="hidden" id="yr" name="yr" value="<?php if (isset($_POST['yr'])) {
                            echo $_POST['yr'];
                        } ?>">

                        <button type="submit" class="btn btn-primary" targte="_blank"name="report" value="report">
                            <i class="fa fa-print"></i>&nbsp; Print Report</button>


                    </span>


                </form>




            </div>
            <!-- /.col-lg-12 -->
        </div>


        <div class="row">
            <div class="col-lg-12 btn btn-danger btn-block btn-lg"
                style="margin-bottom:10px;    line-height: 28px;
                    height: 36px;"> Search Reasult For :
                Year - <?php if (isset($_POST['yr'])) {
                    echo $_POST['yr'];
                } ?>
                and Month: <?php if (isset($_POST['monid'])) {
                    if ($_POST['monid'] == '10') {
                        echo 'October';
                    } elseif ($_POST['monid'] == '11') {
                        echo 'November';
                    } elseif ($_POST['monid'] == '12') {
                        echo 'December';
                    } elseif ($_POST['monid'] == '1') {
                        echo 'january';
                    } elseif ($_POST['monid'] == '2') {
                        echo 'February';
                    } elseif ($_POST['monid'] == '3') {
                        echo 'March';
                    } elseif ($_POST['monid'] == '4') {
                        echo 'April';
                    } elseif ($_POST['monid'] == '5') {
                        echo 'May';
                    } elseif ($_POST['monid'] == '6') {
                        echo 'JUne';
                    } elseif ($_POST['monid'] == '7') {
                        echo 'JUly';
                    } elseif ($_POST['monid'] == '8') {
                        echo 'August';
                    } elseif ($_POST['monid'] == '9') {
                        echo 'September';
                    } else {
                    }
                }
                
                ?> </div>
            <br>
            <div class="col-lg-12" style="padding:0px">

                <table id="example" id="TestTable" class="table table-bordered table-hover" cellspacing="0"
                    style="font-size:12px;width:100%">

                    <thead class="thead-dark">
                        <tr>
                            {{-- <th>Item Id</th> --}}
                            <th>#</th>
                            <th>Vehcile Name </th>
                            <th>Total Distance</th>
                            <th>Total Oil </th>
                            <th>Oil Cost </th>
                            <th>Total Gas </th>
                            <th>Gas Cost </th>
                            <th>Total Fuel Consumed</th>
                            <th>Oil : Gas</th>
                            <th>Per Litre Distance Covered</th>
                            <th>Per KM Cost</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($totaldistance as $distance)
                            <tr>
                                <td>{{ $loop->index + 1 }} </td>
                                <td>{{ $distance->vehicle_name }}</td>
                                <td>{{ $distance->distance_covered }} KM</td>


                                @foreach ($fuel_info_oil as $fuel)
                                    @if ($fuel->vehicleId == $distance->vehicle_id)
                                        @if ($fuel->fuelType == 1)
                                            <td style="height:60px" id="totaloil">
                                                {{ $fuel->total }}
                                            </td>
                                            <td style="height:60px">
                                                {{ $fuel->totalcost }} TK
                                            </td>
                                        @else
                                            <td style="height:60px">0 </td>
                                        @endif
                                    @endif
                                @endforeach

                                @foreach ($fuel_info_gas as $fuel)
                                    @if ($fuel->vehicleId == $distance->vehicle_id)
                                        @if ($fuel->fuelType == 2)
                                            <td style="height:60px" id="totalgas">
                                                {{ $fuel->total }}
                                            </td>
                                            <td style="height:60px">
                                                {{ $fuel->totalcost }} TK
                                            </td>
                                        @else
                                            <td style="height:60px">0 </td>
                                        @endif
                                    @endif
                                @endforeach

                                @foreach ($fuel_info_all as $fuels)
                                    @if ($fuels->vehicleId == $distance->vehicle_id)
                                        <td style="height:60px">{{ $fuels->total }} L</td>
                                    @endif
                                @endforeach



                                @foreach ($fuel_info_oil as $fuel)
                                    @if ($fuel->vehicleId == $distance->vehicle_id)
                                        @if ($fuel->fuelType == 1)
                                            <td style="height:60px" id="n">
                                                {{ $fuel->total }}

                                                @foreach ($fuel_info_gas as $fuel)
                                                    @if ($fuel->vehicleId == $distance->vehicle_id)
                                                        @if ($fuel->fuelType == 2)
                                                            : {{ $fuel->total }}
                                                        @else
                                            <td style="height:60px">0 </td>
                                        @endif
                                    @endif
                                @endforeach
                                </td>
                            @else
                                <td style="height:60px">0 </td>
                        @endif
                        @endif
                        @endforeach

                        @foreach ($fuel_info_all as $fuels)
                            @if ($fuels->vehicleId == $distance->vehicle_id)
                                @if ($fuels->total != 0)
                                    <td style="height:60px">
                                        {{ number_format($distance->distance_covered / $fuels->total, 2) }} KM
                                    </td>
                                    <td style="height:60px" id="tanim">
                                        {{ number_format($fuels->totalcosts / $distance->distance_covered, 2) }} TK
                                        {{-- <script>
                                            const myElement = document.getElementById("tanim");
                                            myElement.style.color = "red";
                                        </script> --}}
                                    </td>
                                @endif
                            @endif
                        @endforeach



                        </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>


        </div>


    </div>

    {{-- <script>
        // const myElement = document.getElementById("tanim");
        // myElement.style.color = "red";
        // var x = document.getElementById("totaloil").value;
        // var x = document.getElementById("totaloil").value;

        document.getElementById("n").innerHTML = x;
    </script> --}}
    <script>
        var x = document.getElementById("example").rows.length;


        for (let i = 1; i < x; i++) {

            var t = document.getElementById("example")
                .rows[i].cells[3].innerHTML * 100 / document.getElementById("example").rows[i].cells[5]
                .innerHTML;
            let n = t.toFixed();
            document.getElementById("example").rows[i].cells[8].innerHTML = parseInt(n) + " : " + parseInt(100 - n);
            if (t == Infinity) {

                document.getElementById("example").rows[i].cells[8].innerHTML = "100 % Oil";
            }
            if (t == 0) {

                document.getElementById("example").rows[i].cells[8].innerHTML = "100 % Gas";
            }
        }
    </script>
@endsection
