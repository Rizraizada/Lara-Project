@extends('layout.master')
@section('content')
    <!-- Breadcubs Area Start Here -->
    <!-- Breadcubs Area Start Here -->
    <div class="dashboard-content-one">
        <!-- Breadcubs Area Start Here -->
        <div class="breadcrumbs-area">

            <a href="{{ route('home') }}" title="Home">HOME</a> /
            <a href="{{ route('fuelgas.entry') }}" title="Course">FUEL/GAS REGISTER RECORDS</a>

        </div>

        <div class="row">
            <div class="col-lg-12">
                <h6 class="page-header">FUEL/GAS REGISTER RECORDS
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

                <div class="modal fade" id="standard-modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Fuel/Gas</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('fuelgas.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">

                                    <div class="col-md-8">
                                        <label for="vehicleid">Vehcile</label>
                                        <select name="vehicleId" id="vehicleId" class="form-control" required>
                                            <option value="">Select Vehicle  Name</option>
                                            @foreach ($vehicles as $vehicle)
                                                <option value="{{ $vehicle->id }}">
                                                    {{ $vehicle->item_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row col-md-12">
                                        <div class="col-md-6">
                                            <label for="driverid">Driver name</label>
                                            <select class="form-control" id="driverId" name="driverId" class="form-control"
                                                required>
                                                <option value="">Select Driver</option>
                                                <option value="1">Md Ariful Islam Raju </option>
                                                <option value="2">Md Saju </option>
                                                <option value="3">Md Shahin mia </option>
                                                <option value="4">Md Masum howlader </option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="supplierName">Supplier Name</label>
                                            <input type="text" id="supplierName" class="form-control mb-3"
                                                placeholder="Enter Supplier Name" name="supplierName" required>
                                        </div>
                                    </div>
                                    <div class="row col-md-12">
                                        <div class="col-md-6">
                                            <label for="fuelType">Fuel Type</label>
                                            <select class="form-control" id="fuelType" name="fuelType" class="form-control"
                                                required>
                                                <option value="">Select fuel type</option>
                                                <option value="1">Oil</option>
                                                <option value="2">Gas</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="memoNo">Memo No</label>
                                            <input type="text" id="memoNo" class="form-control mb-3"
                                                placeholder="Enter Memo No" name="memoNo" required>
                                        </div>
                                    </div>

                                    <div class="row col-md-12">
                                        <div class="col-md-6">
                                            <label for="Unit Rate">Unit Rate</label>
                                            <input type="text" id="unitRate" class="form-control mb-3"
                                                placeholder="Enter Unit Rate" name="unitRate" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="totalUnit">Total Unit</label>
                                            <input type="text" id="totalUnit" class="form-control mb-3"
                                                placeholder="Enter Total Unit" name="totalUnit" required>
                                        </div>
                                    </div>

                                    <div class="row col-md-12">
                                        <div class="col-md-6">
                                            <label for="totalCost">Total Cost</label>
                                            <input type="text" id="totalCost" class="form-control mb-3"
                                                placeholder="Enter Total Cost" name="totalCost" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="fuelDate">Fuel Date</label>
                                            <input type="date" id="fuelDate" class="form-control mb-3"
                                                placeholder="Enter Duration From" name="fuelDate">
                                        </div>
                                    </div>

                                    <div class="row col-md-12">

                                        <div class="col-md-6">
                                            <label for="verified_by">Verified by</label>
                                            <input type="text" id="verifiedBy" class="form-control mb-3"
                                                placeholder="Enter Verified user name" name="verifiedBy" required>
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
                    <th>Sl no</th>
                    <th>Vehicle</th>
                    <th>Driver </th>
                    <th>Supplier </th>
                    <th>Fuel type </th>
                    <th>Memo No </th>
                    <th>Unit Rate </th>
                    <th>Total Unit (ltr)</th>
                    <th>Total Cost  </th>
                    <th>Date </th>
                    <th>Verified by </th>
                    <th>Created By</th>


                    <th width="5%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allfuels as $item)
                    <tr>
                        <td>{{ $allfuels->firstItem() + $loop->index }} </td>
                        <td>{{ $item->vehicle_name }}</td>
                        <td>{{ $item->driver_name }}</td>
                        <td>{{ $item->supplierName }}</td>
                        <td> @if($item->fuelType==1)
                            Oil
                            @else
                            Gas

                        @endif
                    </td>
                        <td>{{ $item->memoNo }}</td>
                        <td>{{ $item->unitRate }}</td>
                        <td>{{ $item->totalUnit }}</td>
                        <td>{{ $item->totalCost }}</td>
                        <td> {{ \Carbon\Carbon::parse($item->fuelDate)->format('Y-m-d')}} </td>
               
                        <td>{{ $item->verifiedBy }}</td>
                        <td>{{$item->createby}}</td>

                        <td>



                            <div class="nav">
                                <a title="Edit" href="" class="btn btn-primary btn-xs nav-link mr-3"
                                    data-toggle="modal" data-target="#edit-modal{{ $item->id }}"><i
                                        class="fa fa-edit"></i> </a>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="edit-modal{{ $item->id }}" tabindex="-1"
                                    role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit FUEL/GAS REGISTER RECORDS</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('fuelgas.update', $item->id) }}" method="POST">
                                                @csrf
                                                <div class="form-group">

                                                    <div class="col-md-8">
                                                        <label for="vehicleid">Vehcile</label>

                                                        <select name="vehicleId" id="vehicleid"   class="form-control" required>
                                                       <option value="">Select Vehicle</option>
                                                       @foreach ($vehicles as $vehicle)
                                                           <option  value=" {{ $vehicle->id }}"
                                                               {{ $vehicle->id == $item->vehicleId ? 'selected' : null }}>
                                                               {{ $vehicle->item_name  }}
                                                           </option>
                                                       @endforeach
                                                   </select>


                                                    </div>
                                                    <div class="row col-md-12">
                                                        <div class="col-md-6">
                                                            <label for="driverid">Driver name</label>

                                                            <select name="driverid" id="driverid"   class="form-control" required>
                                                       <option value="">Select Driver</option>
                                                       @foreach ($drivers as $driver)
                                                           <option  value=" {{ $driver->id }}"
                                                               {{ $driver->id == $item->driverId ? 'selected' : null }}>
                                                               {{ $driver->driver_name  }}
                                                           </option>
                                                       @endforeach
                                                   </select>

                                                </div>
                                                        <div class="col-md-6">
                                                            <label for="supplierName">Supplier Name</label>
                                                            <input type="text" id="supplierName"
                                                                class="form-control mb-3"
                                                                value="{{ $item->supplierName }}"
                                                                placeholder="Enter Supplier Name" name="supplierName"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="row col-md-12">
                                                        <div class="col-md-6">
                                                            <label for="fuelType">Fuel Type</label>

                                                    <select name="fuelType" id="fuelType"   class="form-control" required>
                                                       <option value="">Select Fuel</option>
                                                       @foreach ($fuels as $fuel)
                                                           <option  value=" {{ $fuel->id }}"
                                                               {{ $fuel->id == $item->fuelType ? 'selected' : null }}>
                                                               {{ $fuel->fuel_name  }}
                                                           </option>
                                                       @endforeach
                                                   </select>


                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="memoNo">Memo No</label>
                                                            <input type="text" id="memoNo"
                                                                class="form-control mb-3" placeholder="Enter Memo No"
                                                                value="{{ $item->memoNo }}" name="memoNo" required>
                                                        </div>
                                                    </div>

                                                    <div class="row col-md-12">
                                                        <div class="col-md-6">
                                                            <label for="Unit Rate">Unit Rate</label>
                                                            <input type="text" id="unitRate"
                                                                class="form-control mb-3" placeholder="Enter Unit Rate"
                                                                value="{{ $item->unitRate }}" name="unitRate" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="totalUnit">Total Unit</label>
                                                            <input type="text" id="totalUnit"
                                                                class="form-control mb-3" placeholder="Enter Total Unit"
                                                                value="{{ $item->totalUnit }}" name="totalUnit" required>
                                                        </div>
                                                    </div>

                                                    <div class="row col-md-12">
                                                        <div class="col-md-6">
                                                            <label for="totalCost">Total Cost</label>
                                                            <input type="text" id="totalCost"
                                                                class="form-control mb-3" placeholder="Enter Total Cost"
                                                                value="{{ $item->totalCost }}" name="totalCost" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="FuelDate">Date</label>
                                                            <input type="date" id="FuelDate"
                                                                class="form-control mb-3"
                                                                placeholder="Enter Duration From" name="FuelDate">
                                                        </div>
                                                    </div>

                                                    <div class="row col-md-12">

                                                        <div class="col-md-6">
                                                            <label for="verified_by">Verified by</label>
                                                            <input type="text" id="verifiedBy"
                                                                class="form-control mb-3"
                                                                placeholder="Enter Verified user name" name="verifiedBy"
                                                                value="{{ $item->verifiedBy }}" required>
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
                        </td>
                    </tr>
                @endforeach

            </tbody>

        </table>
        <div class="d-felx justify-content-center">

            {{ $allfuels->links() }}

        </div>
        <p>
            Displaying {{ $allfuels->count() }} of {{ $allfuels->total() }} data(s).
        </p>
    </div>
@endsection
