@extends('layout.master')
@section('content')



<div class="dashboard-content-one">
        <!-- Breadcubs Area Start Here -->
        <div class="breadcrumbs-area">
            <ul>
                <li>
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <a href="{{ route('module.index') }}" title="Course">new Note Creation</a
            </ul>
        </div>

   


        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">List of Notes
                    <a title="new note create" href=# class="btn btn-primary" data-toggle="modal" data-target="#standard-modal">
                        <i class="fa fa-plus-circle fw-fa"></i> New
                    </a>
                </h2>
                @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    <strong>{{ $message }}</strong>
                                </div>
                @endif
                <!-- Modal -->
                <div class="modal fade" id="standard-modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add New Note</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('module.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="name">File Name</label>
                                            {{-- <input type="text" id="name" class="form-control mb-3" placeholder="Name"
                                                name="module_name"> --}}
                                            <select name="batch" id="" class="form-control" required>
                                                <option value="">Select One</option>
                                                @foreach ($batchList as $batch)
                                                    <option value="{{ $batch->id }}">{{ $batch->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    
                                        <div class="col-md-6">
                                            <label for="name">Note Heading</label>
                                            <input type="text" id="name" class="form-control mb-3" placeholder="Name"
                                                name="module_name" required>
                                        </div>
                                     </div>

                                     <div class="col-md-12">
                                     <label for="name">Note Description</label>
                                     <textarea id="desc" name="desc"  rows="1" cols="90" ></textarea>
                                     </div>
                                     <div class="col-md-12">
                                        <label for="name"><b> <p class="text-success">Note Details</p></b></label>
                                        <select name="offer_id" id="template_id" class="form-control dynamic" data-dependent="details" >
                                            <option value="" > Select Template </option>
                                            @foreach ( $templateslist as $row )
                                            <option value="{{ $row->id }}">{{ $row->template_name }}</option>
                                            @endforeach
                                        </select>

                                        <textarea class="ckeditor form-control" name="month" id="template_textarea" class="template_textarea" required></textarea>

                                    </div>

                                    <div class="col-lg-6 col-12 form-group mg-t-30">
                                     <label class="text-dark-medium">Attachment(Not Greater than 20MB)(only pdf file allowed)</label>
                                    <input type="file" name='file' id='chooseFile' accept=".pdf" class="form-control-file">
                                    </div>
                                    <div class="col-md-12 p-3">
                                                    <label for="note_action">Action*</label>
                                                    <select class="form-control" id="batch_description" name="note_action"
                                                        class="form-control" required>
                                                        
                                                        <option value="1">Apply </option>
                                                        <option value="0">Draft </option>
                                                    </select>
                                    </div>

                                    <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="forward">Is Old File*:</label><br>
                                    <input type="radio"  id="option3" name="oldfile" value="1" checked>YES</label>

                                    <input type="radio" id="option4" name="oldfile" value="0" checked >NO</label>
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

            <thead>
                <tr>
                     <th>#</th> 
                    <th>Department</th>
                    <th>File No.</th>
                    <th>File Name</th>
                    <th>Note No.</th>
                    <th>Sub Note No.</th>
                    <th>Note Heading</th> 
                    <th>Note Description</th>             
                    <th>Approval Flow</th>
                    <th>Attachment</th>
                    <th>File Status</th>
                    <th width="20%">Action</th>
                </tr>
            </thead>
            <tbody>
@foreach ($moduleList as $module)
    <tr>
                       
                        <td>{{ $moduleList->firstItem() + $loop->index }} </td>
                        <td>{{ $module->department }}</td>
                        <td>{{ $module->year }}</td> 
                        <td>{{ $module->filename }}</td> 
                        <td>{{ $module->note_no }}</td>

                        @if($module->subnote!='' )
                        <td>{{ $module->note_no }}.{{ $module->subnote }}</td>
                        @else
                        <td></td>
                        @endif
                         <td>{{ $module->name }}</td>  
                         <td>{{ $module->description }}</td>  
                         
                         
                        <td>
                        
                        <a href="{{ route('module.approve', $module->id) }}"
                                                        class="btn btn-info">Approval Flow</a> 
                        </td> 

                        
                        @if($module->file_name==''||$module->file_name=='test.pdf')
                        <td></td>
                        @else
                        <td align='center'> <a href="<?php echo asset("/images/".$module->file_name) ?>" target="_BLANK"> <i class='fa fa-download'> </i> </a> </td>
                        @endif  
                        
                        @if(($module->forwarded=='Y') && ($module->status==''))
                            <td> Forwarded </td>
                        @else
                            <td>{{ $module->status }} </td>
                        @endif
                         
                        
                        @if($module->note_status!=1)
                            <td>
                         
                              <a title="View" href="{{ route('outbox.edit', $module->id) }}"
                                                        class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a>
                             <a title="Report" href="{{ route('note.report', $module->id) }}" target='_blank'
                                                        class="btn btn-info"><i class="fa fa-print"></i></a>
                                           
                        <a title="Edit" href="" class="btn btn-primary btn-xs" data-toggle="modal"
                                data-target="#edit-modal{{ $module->id }}"><i class="fa fa-edit"></i></a>
                                    <!-- Edit Modal -->
                            <div class="modal fade" id="edit-modal{{ $module->id }}" tabindex="-1" role="dialog"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Note Information</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('module.update', $module->id) }}" method="POST" enctype="multipart/form-data"  >
                                            @csrf
                                            <div class="form-group">
                                               

                                                <div class="row">
                                                <div class="col-md-6">
                                                    <label for="name">File Name</label>
                                                    <input type="text" id="name" class="form-control mb-3"
                                                        placeholder="Name" name="module_name"
                                                        value="{{ $module->filename }}" readonly>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="name">Note Heading</label>
                                                    <input type="text" id="name" class="form-control mb-3"
                                                        placeholder="Name" name="module_name"
                                                        value="{{ $module->name }}" >
                                                </div>
                                                </div> 

                                                <div class="col-md-12">
                                     <label for="name">Note Description</label>
                                     <textarea  class="form-control" id="description" name="description"  rows="1" cols="90" >{{ $module->description 
                                                    }}</textarea>
                                     </div>
                                     <br>
                                           
                                                <div class="col-md-12">
                                                    <label for="month">Note Details</label>
                                            

                                                <textarea class="ckeditor form-control" id="module_description" name="module_description" >  
                                                    {{ $module->month 
                                                    }}                                        
                                                </textarea>

                                                </div>
                                                    <div class="col-lg-6 col-12 form-group mg-t-30">
                                                    <label class="text-dark-medium">Attachment(Not Greater than 20MB)(only pdf file allowed)</label>
                                                    <input type="file" name='file' id='chooseFile' accept=".pdf" class="form-control-file">
                                                    </div>
                                                <div class="col-md-12 p-3">
                                                    <label for="note_action">Action*</label>
                                                    <select class="form-control" id="batch_description" name="note_action"
                                                        class="form-control" required>
                                                        
                                                        <option value="1">Apply </option>
                                                        <option value="0">Draft </option>
                                                    </select>
                                                </div>

                                            </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="footer-btn bg-linkedin"> Save</button>
                                                </div>
                                           
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <a title="Delete" href="" class="btn btn-danger btn-xs" data-toggle="modal"
                                data-target="#delete-modal{{ $module->id }}"><i class="fa fa-trash"></i></a>

                            <!-- delete Modal -->
                            <div class="modal fade" id="delete-modal{{ $module->id }}" tabindex="-1" role="dialog"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Are You Sure</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('module.delete', $module->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-footer">
                                                <button type="submit" class="footer-btn btn btn-danger"> Delete</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>

     @elseif($module->status=='Rejected')
     <td>
              <a title="Edit" href="" class="btn btn-primary btn-xs" data-toggle="modal"
                                data-target="#edit-modal{{ $module->id }}"><i class="fa fa-edit"></i></a>

 <!-- Edit Modal -->
                            <div class="modal fade" id="edit-modal{{ $module->id }}" tabindex="-1" role="dialog"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Note Information</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('module.update', $module->id) }}" method="POST" enctype="multipart/form-data"  >
                                            @csrf
                                            <div class="form-group">
                                               

                                                <div class="row">
                                                <div class="col-md-6">
                                                    <label for="name">File Name</label>
                                                    <input type="text" id="name" class="form-control mb-3"
                                                        placeholder="Name" name="module_name"
                                                        value="{{ $module->filename }}" readonly>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="name">Note Heading</label>
                                                    <input type="text" id="name" class="form-control mb-3"
                                                        placeholder="Name" name="module_name"
                                                        value="{{ $module->name }}" >
                                                </div>
                                                </div> 

                                    <div class="col-md-12">
                                     <label for="name">Note Description</label>
                                     <textarea class="form-control" id="description" name="description"  rows="1" cols="90" > {{ $module->description 
                                                    }}</textarea>
                                     </div>
                                        <br>   
                                                <div class="col-md-12">
                                                    <label for="month">Note Details</label>
                                            

                                                <textarea class="ckeditor form-control" id="module_description" name="module_description" >  
                                                    {{ $module->month 
                                                    }}                                        
                                                </textarea>

                                                </div>
                                                    <div class="col-lg-6 col-12 form-group mg-t-30">
                                                    <label class="text-dark-medium">Attachment(Not Greater than 20MB)(only pdf file allowed)</label>
                                                    <input type="file" name='file' id='chooseFile' accept=".pdf" class="form-control-file">
                                                    </div>
                                                <div class="col-md-12 p-3">
                                                    <label for="note_action">Action*</label>
                                                    <select class="form-control" id="batch_description" name="note_action"
                                                        class="form-control" required>
                                                        
                                                        <option value="1">Apply </option>
                                                        <option value="0">Draft </option>
                                                    </select>
                                                </div>

                                            </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="footer-btn bg-linkedin"> Save</button>
                                                </div>
                                           
                                        </form>
                                    </div>
                                </div>
                            </div>
                         
                            
        <a title="View" href="{{ route('outbox.edit', $module->id) }}"
                        class="btn btn-info">
<i class="fa fa-eye" aria-hidden="true"></i></a>

     <a title="Report" href="{{ route('note.report', $module->id) }}"
        class="btn btn-info" target='_blank'><i class="fa fa-print"></i></a></td>

@else
    <td> <a title="View" href="{{ route('outbox.edit', $module->id) }}"
                                                        class="btn btn-info">
            <i class="fa fa-eye" aria-hidden="true"></i></a>

         <a title="Report" href="{{ route('note.report', $module->id) }}"
                                                        class="btn btn-info" target='_blank'><i class="fa fa-print"></i></a>
 
                                                        

        @if($module->subnote=='' && $module->isoldfile!=1)


            <a title="sub note" href="{{ route('subnote.create', $module->id) }}"
                        class="btn btn-success">
            <i class="fa fa-plus-circle fw-fa" aria-hidden="true"></i></a>

        @endif 

    </td>
@endif    

</tr>
@endforeach

            </tbody>

        </table>
        <div class="d-felx justify-content-center">

            {{ $moduleList->links() }}

        </div>
        <p>
            Displaying {{$moduleList->count()}} of {{ $moduleList->total() }} Note(s).
            </p>
</div>
@endsection
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('scripts')

<script type="text/javascript">
    $('#template_id').on('change', function() {
        // $(".template_details").hide();
        var id = $(this).find('option:selected').val();

        let _url = `/templatedtl/${id}`;

        $.ajax({
            url: _url,
            type: 'GET',
            data: {
                id: id
            }
        }).done(function(data) {

            //     var string = JSON.stringify(data);
            // let obj = JSON.parse(string);
            // let arrValues = Object.values(obj);
            // console.log("template" +obj);
            table_templates(data.data)
        });

        function table_templates(data) {

            var rows = '';
            $.each(data, function(key, value) {

                //     rows = rows + '<div class="template_details" id="template_details_"'+value.id+'">';
                //     rows = rows + '<textarea class="ckeditor form-control" name="details">' + value.template_details + '</textarea>';
                //  rows = rows + '</div>';

                rows = value.template_details;

            });
            // console.log(rows);
            // $("#template_textarea").text(rows);
            // $("#template_textarea").html(rows);
            // document.getElementById("template_textarea").innerHTML = rows;


            // CKEDITOR.replace('template_textarea');
            //set data
            CKEDITOR.instances['template_textarea'].setData(rows);
        }

    });
</script>



@endsection