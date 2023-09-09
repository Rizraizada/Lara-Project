@extends('layout.master')
@section('content')
    <!-- Breadcubs Area Start Here -->
    {{-- <div class="breadcrumbs-area">
        <h3>Admin Dashboard</h3>
        <ul>
            <li>
                <a href="{{ route('home') }}">Home</a>
            </li>
            <li>Admin</li>
        </ul>
    </div> --}}
    <div class="content-wrapper">
        <!-- <section class="content-header">
            <h1>
                User Creation
            </h1>
        </section> -->

        <section class="content">
            
             
                     <div class="row">
                         <div class="col-lg-12">
                             <h1 class="page-header">List of User
                                <a href=# class="btn btn-primary" data-toggle="modal" data-target="#standard-modal">
                                    <i class="fa fa-plus-circle fw-fa"></i> New
                                </a>
                            </h1>
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    <strong>{{ $message }}</strong>
                                </div>
                             @endif

                             @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif



                             @if ($message = Session::get('error'))
                                <div class="alert alert-danger">
                                    <strong>{{ $message }}</strong>
                                </div>
                             @endif
                <!-- Modal -->
                            <div class="modal fade" id="standard-modal" tabindex="-1" role="dialog" aria-hidden="true">
                             <div class="modal-dialog modal-lg" role="document">
                             <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title">Add New User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                 </div>
                           
                             <form action="{{ route('participant.store') }}" method="POST" enctype="multipart/form-data" >
                             @csrf
                             <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                    <label>Name*</label>
                                    <input class="form-control" type="text" placeholder="Employee Name" name="name" 
                                    value="{{old('name')}}"  >
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email*</label>
                                        <input class="form-control" type="text" placeholder="Employee email" name="email" 
                                        value="{{old('email')}}" required >
                                    </div>
                                </div>
                             </div>

                      

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone Number*</label>
                                        <input class="form-control" type="number" placeholder="Phone Number" name="phone_no"
                                        value="{{old('phone_no')}}" required>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-12 form-group mg-t-30">
                                     <label class="text-dark-medium">Signature</label>
                                    <input type="file" name='file' id='chooseFile' class="form-control-file">
                                </div> 

                                <!-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Photo</label>
                                        <input class="form-control" type="file" name="photo">
                                    </div>
                                </div> -->
                            
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">    
                                    <label for="pssword">Password:*</label><br>
                                    <input type="password" id="password" name="password" required>                                
                                </div>


                                <div class="col-md-6  form-group">
                                <label>User Type *</label>
                                <select name="type_id" id="type_id" class="form-control" required>
                                                        <option value="">Please Select Type *</option>
                                                        <option value="1">User</option> 
                                                        <option value="2">HOD</option>                              
                                                        <option value="3">Admin</option>     
                                                        <option value="4">Director</option>  
                                                        <option value="5">Board Member</option>                        
                                                    </select>
                                </div>

                            </div> 

                            <div class="row">
                            
                                            <div class="col-md-6 form-group">
                                                        <label for="intake_id">Department*</label>
                                                        <select name="intake_id" id="intake_id" class="form-control" required>
                                                            <option value="">Select Department</option>
                                                            @foreach ($intakes as $intake)
                                                                <option value="{{ $intake->id }}">
                                                                    {{ $intake->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                             </div>

                                             <div class="col-md-6 form-group">
                                                        <label for="desig_id">Deignation*</label>
                                                        <select name="desig_id" id="desig_id" class="form-control" required>
                                                            <option value="">Select Deignation</option>
                                                            @foreach ($designations as $desig)
                                                                <option value="{{ $desig->id }}">
                                                                    {{ $desig->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                             </div>

                                       

                            </div>
                            <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="pssword">Approval Flow*:</label><br>
                                    <input type="radio"  id="option1" name="status" value="1" checked>YES</label>

                                    <input type="radio" id="option2" name="status" value="0" >NO</label>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="forward">Managing Director Forward List*:</label><br>
                                    <input type="radio"  id="option3" name="forward" value="1" checked>YES</label>

                                    <input type="radio" id="option4" name="forward" value="0" checked >NO</label>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-12 form-group mg-t-8">
                                                        <button type="submit"
                                                            class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                                        <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                                                    </div>
                                                </div>
                       


                            </div>
                        
                        </form>
                    </div>
                    </div>
                </div>
            </div>
            <!-- /.col-lg-12 -->
             </div>

         </div>
        </section>

        <table id="example" class="table table-bordered table-hover" cellspacing="0" style="font-size:12px">

            <thead>
                <tr>
                    <th>#</th> 
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Department</th>
                    <th>Deisgnation</th>
                    <th>Roles</th>
                    <th>Signature</th>
                 
                    <th width="20%">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($userlist as $user)
                    <tr>
                    <td>{{ $userlist->firstItem() + $loop->index }} </td> 
                         <td>{{ $user->name }}</td> 
                         <td>{{ $user->email }}</td> 
                         <td>{{ $user->phone_no }}</td>    
                         <td>{{ $user->department }}</td> 
                         <td>{{ $user->designation }}</td>
                        @if($user->role=='1')
                        <td>User</td>
                        @elseif($user->role=='2')
                        <td>HOD</td>
                        @elseif($user->role=='3')
                        <td>Admin</td>
                        @elseif($user->role=='4')
                        <td>Director</td>
                        @elseif($user->role=='5')
                        <td>Board Member</td>
                        @else
                        <td></td>
                        @endif

                        @if($user->signature_file_name!='')
                        <td><img src="images/{{ $user->signature_file_name }}" height="50" width="70"></td>
                        @else
                        <td></td> 
                        @endif 

                      
               
                        <td> <a title="Edit" href="" class="btn btn-primary btn-xs" data-toggle="modal"
                                data-target="#edit-modal{{ $user->id }}"><i class="fa fa-edit"></i></a>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="edit-modal{{ $user->id }}" tabindex="-1" role="dialog"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit User Information</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('participant.update', $user->id) }}" method="POST" enctype="multipart/form-data" >
                                            @csrf
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="name">User Name</label>
                                                    <input type="text" id="name" class="form-control" placeholder="Name"
                                                        name="user_name" value="{{ $user->name }}">
                                                </div>
                                                 <div class="col-md-12">
                                                    <label for="name">Email</label>
                                                    <input type="text" id="user_email" class="form-control"
                                                        placeholder="email" name="email" value="{{ $user->email }}">
                                                </div> 
                                                
                                                <div class="col-md-12">
                                                    <label for="name">Phone No.</label>
                                                    <input type="text" id="batch_year" class="form-control"
                                                        placeholder="phone" name="phone_no" value="{{ $user->phone_no }}">
                                                </div>
                                                 <div class="col-md-12">
                                                    <label for="intake_id">Departemnt</label>
                                                    <select name="intake_id" id="intake_id"   class="form-control" required>
                                                        <option value="">Select Departemnt</option>
                                                        @foreach ($intakes as $intake)
                                                            <option  value=" {{ $intake->id }}"
                                                                {{ $intake->id == $user->intake_id ? 'selected' : null }}>
                                                                {{ $intake->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="desig_id">Designation</label>
                                                    <select name="desig_id" id="desig_id"   class="form-control" required>
                                                        <option value="">Select designation</option>
                                                        @foreach ($designations as $desig)
                                                            <option  value=" {{ $desig->id }}"
                                                                {{ $desig->id == $user->desig_id ? 'selected' : null }}>
                                                                {{ $desig->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div> 
                                                <div class="col-lg-6 col-12 form-group mg-t-30">
                                                <label class="text-dark-medium">Signature</label>
                                                <input type="file" name='file' id='chooseFile' class="form-control-file">
                                                </div>

                                                <div class="col-md-12">
                                                
                                                    <label for="pssword">Approval Flow:</label><br>
                                                    <input type="radio"  id="option1" name="status" value="1" {{ ($user->is_flow=="1")? "checked" : "" }}>YES</label>

                                                    <input type="radio" id="option2" name="status" value="0"  {{ ($user->is_flow=="0")? "checked" : "" }} >NO</label>
                                              
                                                </div>

                                                <div class="col-md-12">
                                               
                                                <label for="forward">Managing Director Forward List:</label><br>
                                                <input type="radio"  id="option3" name="forward" value="1"
                                                 {{ ($user->is_mdlist=="1")? "checked" : "" }} >YES</label>

                                                <input type="radio" id="option4" name="forward" value="0"   {{ ($user->is_mdlist=="0")? "checked" : "" }} >NO</label>
                                                
                                                </div>
                                        <div class="col-md-12">
                                                
                                                <label for="pssword">Replace Flow On leave :</label><br>
                                                <input type="radio"  id="option5" name="replaceflow" value="1" {{ ($user->replace_flow=="1")? "checked" : "" }}>YES</label>

                                                <input type="radio" id="option6" name="replaceflow" value="0"  {{ ($user->replace_flow=="0")? "checked" : "" }} >NO</label>
                                          
                                        </div>


                            <div class="col-md-12">
                                               
                                    <label>User Type *</label>
                                    <select name="type_id" id="type_id" class="form-control">
                                    <option value="">Select User Type</option>
                                             @foreach ($roles as $role)
                                            <option  value=" {{ $role->id }}"
                                            {{ $role->id == $user->role ? 'selected' : null }}>
                                             {{ $role->role_name }}
                                            </option>
                                             @endforeach                        
                                        </select>
                            </div>
                                                
                                                

                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="footer-btn bg-linkedin"> Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                      @if($user->role!='3')
                           <a title="Delete" href="" class="btn btn-danger btn-xs" data-toggle="modal"
                                data-target="#delete-modal{{ $user->id }}"><i class="fa fa-trash"></i></a>
                     @else
                    @endif   
                            <!-- delete Modal -->
                            <div class="modal fade" id="delete-modal{{ $user->id }}" tabindex="-1" role="dialog"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Are you sure?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('participant.delete', $user->id) }}" method="POST">
                                            @csrf

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success"> delete</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            <a title="reset" href="" class="btn btn-success btn-xs" data-toggle="modal" 
                                data-target="#reset-modal{{ $user->id }}"><i class="fa fa-key"></i></a>
                        <!-- reset Modal -->
                            <div class="modal fade" id="reset-modal{{ $user->id }}" tabindex="-1" role="dialog"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">password reset</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('participant.pass_update', $user->id) }}" method="POST"  >
                                            @csrf
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="user_pass">new password</label>
                                                    <input type="text" id="user_pass" class="form-control" 
                                                        name="user_pass" >
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

            {{ $userlist->links() }}

             </div>
             <p>
            Displaying {{$userlist->count()}} of {{ $userlist->total() }} User(s).
            </p>            
</div>
@endsection
