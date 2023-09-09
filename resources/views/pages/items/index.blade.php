@extends('layout.master')
@section('content')
    <!-- Breadcubs Area Start Here -->
      <!-- Breadcubs Area Start Here -->
    
      <div class="dashboard-content-one">
        <!-- Breadcubs Area Start Here -->
        <div class="breadcrumbs-area">
       
            <a href="{{ route('home') }}" title="Home">Home</a> /
            <a href="{{ route('item.entry') }}" title="Course">VEHICLE ENTRY</a>
        
        </div>
    

     


        <div class="row">
            <div class="col-lg-12">
                <h6 class="page-header">VEHICLE LIST
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
                    <div class="modal-dialog" style="width:1250px;" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add New Vehicle</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('item.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">


                                     <div class="col-md-12">
                                        <label for="vehicle_name">Vehicle Name</label>
                                        <input type="text" id="vehicle_name" class="form-control mb-3" placeholder="Enter Vehicle Name"
                                            name="vehicle_name" required>
                                     </div>
                                     <div class="row">

                                     <div class="col-md-6">
                                        <label for="licence_no">Licence No.</label>
                                        <input type="text" id="licence_no" class="form-control mb-3" placeholder="Enter Licence No."
                                            name="licence_no" >
                                     </div>
                                     <div class="col-md-6">
                                        <label for="model_no">Model No.</label>
                                        <input type="text" id="model_no" class="form-control mb-3" placeholder="Enter Model No."
                                            name="model_no" >
                                     </div>
                                     </div>
                                 
                                     <div class="row">

                                        <div class="col-md-6">
                                            <label for="dt_of_lic">Insurance Validaty Period</label>
                                            <input type="date" id="dt_of_lic" class="form-control mb-3" placeholder="Enter Manufacture Year."
                                                name="dt_of_lic" >
                                            </div>
                                            <div class="col-md-6">
                                            <label for="dt_of_fit">Fitness Validaty Period</label>
                                            <input type="date" id="dt_of_fit" class="form-control mb-3" placeholder="Enter Date of Purchase."
                                                name="dt_of_fit" >
                                            </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-md-6">
                                                            <label for="tax_no">  Tax Token No</label>
                                                            <input type="text" id="tax_no" class="form-control" placeholder="Enter  Tax Token No "
                                                                name="tax_no" >
                                                        </div>
                                
                                    <div class="col-md-6">
                                        <label for="dt_of_tax">Tax Validaty Period</label>
                                        <input type="date" id="dt_of_tax" class="form-control mb-3" placeholder="Enter Manufacture Year."
                                            name="dt_of_tax" >
                                    </div>
                                </div>
                                    <div class="row">

                                        <div class="col-md-6">
                                            <label for="manufac_year">Manufacture Year</label>
                                            <input type="date" id="manufac_year" class="form-control mb-3" placeholder="Enter Manufacture Year."
                                                name="manufac_year" >
                                            </div>
                                            <div class="col-md-6">
                                            <label for="dt_of_purc">Date of Purchase</label>
                                            <input type="date" id="dt_of_purc" class="form-control mb-3" placeholder="Enter Date of Purchase."
                                                name="dt_of_purc" >
                                            </div>
                                    </div>

                              


                                    <div class="col-lg-6 col-12 form-group">
                                     <label class="text-dark-medium">Photo</label>
                                    <input type="file" name='file' id='chooseFile' class="form-control-file" >
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
                    <th>Insurence Validity Period </th>
                    <th>Fitness Validity Period </th>
                    <th>Tax Validity Period</th>
                    <th>Vehicle Image</th>
                  
                    <th width="10%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                    <td>{{  $loop->index+1 }} </td>
                        <td>{{ $item->item_name }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->dt_of_lic)->format('d-m-Y')}}</td>
                        <td>{{ \Carbon\Carbon::parse($item->dt_of_fit)->format('d-m-Y')}}</td>
                        <td>{{ \Carbon\Carbon::parse($item->dt_of_tax)->format('d-m-Y')}}</td>
                  
                       
                       

                        @if($item->image_name!='')
                        <td><img  src="https://bdu.nuc-usa.com/images/{{ $item->image_name }}" height="100" width="160" onclick="window.open(this.src)" ></td>
                        @else
                        <td></td> 
                        @endif 
                       
                    
                        <td> 

                        <a title="View" href="{{ route('view.details', $item->id) }}"
                                                        class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a>
                      

                        <div class="nav">
                            <a title="Edit" href="" class="btn btn-primary btn-xs nav-link mr-3" data-toggle="modal"
                                    data-target="#edit-modal{{ $item->id }}"><i class="fa fa-edit"></i> </a>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="edit-modal{{ $item->id }}" tabindex="-1" role="dialog"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Vehicle Information</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('item.update', $item->id) }}" method="POST"  enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="vehicle_name">Vehicle Name</label>
                                                        <input type="text" id="vehicle_name" class="form-control" placeholder="Enter Vehicle Name"
                                                            name="vehicle_name" value="{{ $item->item_name }}">
                                                    </div>

                                                    <div class="row">

                                                    <div class="col-md-6">
                                                    <label for="licence_no">Licence No.</label>
                                                    <input type="text" id="licence_no" class="form-control mb-3" placeholder="Enter Licence No."
                                                        name="licence_no" value="{{ $item->licence_no }}" >
                                                    </div>
                                                    <div class="col-md-6">
                                                    <label for="model_no">Model No.</label>
                                                    <input type="text" id="model_no" class="form-control mb-3" placeholder="Enter Model No."
                                                        name="model_no" value="{{ $item->model_no }}">
                                                    </div>
                                                    </div>
                                                    <div class="row">

                                <div class="col-md-6">
                                    <label for="dt_of_lic">Insurance Validaty Period</label>
                                    <input type="date" id="dt_of_lic" class="form-control mb-3" 
                                        name="dt_of_lic"  value="{{ $item->dt_of_lic }}">
                                    </div>
                                    <div class="col-md-6">
                                    <label for="dt_of_fit">Fitness Validaty Period</label>
                                    <input type="date" id="dt_of_fit" class="form-control mb-3" 
                                        name="dt_of_fit"  value="{{ $item->dt_of_fit }}">
                                    </div>
                                </div>
                                <div class="row">
                                <div class="col-md-6">
                                                        <label for="tax_no">  Tax Token No</label>
                                                        <input type="text" id="tax_no" class="form-control" 
                                                            name="tax_no" value="{{ $item->tax_no }}" >
                                                    </div>
                              
                                <div class="col-md-6">
                                    <label for="dt_of_tax">Tax Validaty Period</label>
                                    <input type="date" id="dt_of_tax" class="form-control mb-3" 
                                        name="dt_of_tax"  value="{{ $item->dt_of_tax }}" >
                                </div>
                                
                                   <div class="col-lg-6 col-12 form-group">
                                     <label class="text-dark-medium">Photo</label>
                                    <input type="file" name='file' id='chooseFile' class="form-control-file" >
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

