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
                             <h1 class="page-header">List of permission
                                <a href=# class="btn btn-primary" data-toggle="modal" data-target="#standard-modal">
                                    <i class="fa fa-plus-circle fw-fa"></i> New
                                </a>
                            </h1>
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
                             <div class="modal-dialog modal-lg" role="document">
                             <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title">Add New role</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                 </div>
                           
        <form method="POST" enctype="multipart/form-data" 
        action="{{ route('participant.setrole', $role_id) }}">
        @csrf
             <div class="row">
                                 
                     @foreach ($allpermissions as $permission)

                    <div class="checkbox">
                  
                    &nbsp; <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" >  <label>
                    {{ ($permission->permission_name) }}
                    </label>
                    <br>
                    </div>
                       
                    @endforeach
            </div> 
                        <div class="modal-footer">
                        <button type="submit" class="footer-btn bg-linkedin"> Update</button>
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

<tbody>
   
    @foreach ($permissions as $permission)
        <tr>
            <td>
                 <div class="checkbox">
                <label>
                    {{ ($permission->permission_name) }}
                </label>
                <input type="checkbox" name="permissions[]" value="{{ $permission->permission_id }}" checked>
                <br>
             </div>
             </td>
    
                  <td>
                 <a title="Delete" href="" class="btn btn-danger btn-xs" data-toggle="modal"
                                data-target="#delete-modal{{ $permission->permission_id }}">Delete</a>

                                <div class="modal fade" id="delete-modal{{ $permission->permission_id }}" tabindex="-1" role="dialog"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Are you sure?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('permission.delete', $permission->permission_id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" id="roleid" name="roleid" value={{$role_id}} >

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success"> delete</button>
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
</div>
@endsection
