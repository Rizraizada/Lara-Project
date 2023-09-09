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

        <p>
            <a href="{{ route('home') }}" title="Home">Home</a> /
            <a href="{{ route('module.index') }}" title="Course">Note Creation</a>
        </p>


<div class="row">
<div class="col-lg-12">
                <h2 class="page-header">Sub Note Creation
                </h2>
                @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    <strong>{{ $message }}</strong>
                                </div>
                @endif
    <form action="{{ route('subnote.store') }}" method="POST" enctype="multipart/form-data"  >
     @csrf
    <div class="form-group">
                                               

            <div class="row">


            <input type="hidden" id="fileid" class="form-control mb-3"
                            placeholder="moduleid" name="moduleid"
                            value="{{ $module->id }}" >

                <input type="hidden" id="fileid" class="form-control mb-3"
                            placeholder="fileid" name="fileid"
                            value="{{ $module->batch_id }}" >

                <input type="hidden" id="noteno" class="form-control mb-3"
                            placeholder="noteno" name="noteno"
                            value="{{ $module->note_no }}" >


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
        <textarea class="form-control" id="description" name="description"  rows="1" cols="90" >{{ $module->description}}</textarea>
            </div>
                <br> 
                
           
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

    </div>
    <div class="modal-footer">
                 <button type="submit" class="btn btn-info btn-lg"> Save</button>
    </div>
                                           
    </form>
                
</div>
</div>          <!-- /.col-lg-12 -->


                         
                        

     
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