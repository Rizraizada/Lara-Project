@extends('layout.master')
@section('styles')
    <style>
        dashboard-content-one {
            overflow: hidden;
        }

    </style>
@endsection
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
            <a href="{{ route('intake.index') }}" title="Intake">Department</a>
        </p>


        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">List of Departments
                    <a href="index.php?view=add" class="btn btn-primary" data-toggle="modal" data-target="#standard-modal">
                        <i class="fa fa-plus-circle fw-fa"></i> New
                    </a>
                </h1>
                @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    <strong>{{ $message }}</strong>
                                </div>
                             @endif
                {{-- <h1 class="page-header">List of Departments</h1> --}}
                {{-- <button type="button" class="modal-trigger" data-toggle="modal" data-target="#standard-modal">
                    new
                </button> --}}
                <!-- Modal -->
                <div class="modal fade" id="standard-modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add New Department</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('intake.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="name">Department Name</label>
                                        <input type="text" id="name" class="form-control mb-3" placeholder="Department Name"
                                            name="intake_name" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="name">Department Prefix</label>
                                        <input type="text" id="dept_prefix" class="form-control mb-3" placeholder="Department Prefix"
                                            name="dept_prefix" required>
                                    </div>

                                    <div class="col-md-12">
                                                        <label for="name">Serial NO. Start</label>
                                                        <input type="text" id="dept_prefix" class="form-control" placeholder="Serial NO"
                                                            name="sl_no" >
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

            <thead>
                <tr>
                    <th>Department Id</th>
                    <th>Department Name</th>
                    <th>Department Prefix</th>
                    <th>Serail No. Start</th>
                    <th width="20%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($intakes as $intake)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $intake->name }}</td>
                        <td>{{ $intake->dept_prefix }}</td>
                        <td>{{ $intake->sl_no }}</td>
                        <td>
                            {{-- <a title="Edit" href="index.php?view=edit&amp;id=0" class="btn btn-primary btn-xs"><i class="fa fa-pencil fa-fw"></i></a>
                                <a title="Delete" href="controller.php?action=delete&amp;id=0" class="btn btn-danger btn-xs"><i class="fa fa-bitbucket  fa-fw"></i> </a> --}}
                            <div class="nav">
                                <a title="Edit" href="" class="btn btn-primary btn-xs nav-link mr-3" data-toggle="modal"
                                    data-target="#edit-modal{{ $intake->id }}"><i class="fa fa-edit"></i> </a>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="edit-modal{{ $intake->id }}" tabindex="-1" role="dialog"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Department Information</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('intake.update', $intake->id) }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label for="name">Department Name</label>
                                                        <input type="text" id="name" class="form-control" placeholder="Name"
                                                            name="intake_name" value="{{ $intake->name }}">
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label for="name">Department Prefix</label>
                                                        <input type="text" id="dept_prefix" class="form-control" placeholder="Department Prefix"
                                                            name="dept_prefix" value="{{ $intake->dept_prefix }}">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="name">Serial NO. Start</label>
                                                        <input type="text" id="sl_no" class="form-control" placeholder="Serial NO"
                                                            name="sl_no" value="{{ $intake->sl_no }}">
                                    </div>
                                                    
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="footer-btn bg-linkedin"> Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-row ">
                                    <div>
                                        <a title="Delete" href="" class="btn btn-danger btn-xs nav-link " data-toggle="modal"
                                            data-target="#delete-modal{{ $intake->id }}"><i class="fa fa-trash"></i> </a>
                                    </div>
                                    <!-- delete Modal -->
                                    <div class="modal fade" id="delete-modal{{ $intake->id }}" tabindex="-1"
                                        role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Are You Sure</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('intake.delete', $intake->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-footer">
                                                        <button type="submit" class="footer-btn btn btn-danger">
                                                            Delete</button>
                                                    </div>
                                                </form>
                                            </div>
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
