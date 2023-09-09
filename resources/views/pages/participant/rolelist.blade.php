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
    <div class="col-lg-12">
        <p>
            <a href="{{ route('home') }}" title="Home">Home</a> /
            <a href="{{ route('participant.rolelist') }}" title="Course">Rolelist</a>
        </p>


        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">List of Roles
                  
                </h1>
                {{-- <h1 class="page-header">List of Roles</h1> --}}
                {{-- <button type="button" class="modal-trigger" data-toggle="modal" data-target="#standard-modal">
                    new
                </button> --}}
                <!-- Modal -->
               
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <table id="example" class="table table-bordered table-hover" cellspacing="0" style="font-size:12px">

            <thead>
                <tr>
                    {{-- <th>Role Id</th> --}}
                    <th>#</th>
                    <th> Role Name</th>
                    <th width="15%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rolelist as $role)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        {{-- <td>{{ $role->role_name }}</td> --}}
                        <td>{{ $role->role_name }}</td>
                        
                        <td>
                             <a href="{{ route('participant.setpermission', $role->id) }}"
                                class="btn btn-info">setpermission</a> 
                        </td>
                     
                    </tr>
                @endforeach

            </tbody>

        </table>

    </div>
@endsection
