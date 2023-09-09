@extends('layout.master')
@section('content')

    <div class="dashboard-content-one">
        <!-- Breadcubs Area Start Here -->
        <div class="breadcrumbs-area">
            <ul>
                <li>
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <a href="{{ route('note.list') }}" title="Course">Note List</a>
            </ul>
        </div>
        <!-- Breadcubs Area End Here -->
        <div class="row">
            <div class="col-lg-12">
            <!-- Add Notice Area Start Here -->
       
                        <div class="heading-layout1">
                            <h1 class="page-header">List of Notes
                            </h1>
                            @if ($message = Session::get('success'))
                                            <div class="alert alert-success">
                                                <strong>{{ $message }}</strong>
                                            </div>
                            @endif
                           
                        </div>
                



    <form action="{{ route('note.filtering') }}" method="POST">
     @csrf

     @if(auth()->user()->role =='4' || auth()->user()->role =='3')
                <div class="row">
                        <div class="col-md-6">
                                        <label for="intake_id">Department</label>
                                        <select name="intake_id" id="intake_id" class="form-control" >
                                            <option value="">Select Department</option>
                                            @foreach ($intakes as $intake)
                                                <option value="{{ $intake->id }}">
                                                    {{ $intake->name }}
                                                </option>
                                            @endforeach
                                        </select>
                        </div>
                </div>
    @endif       
              
        @if(auth()->user()->role =='4' || auth()->user()->role =='3'||auth()->user()->role =='2')

        <div class="row">
            <div class="col-md-6">
                    <label>Type a Note  Subject</label>
                    <input type="text" name="notesubject" id="notesubject" placeholder="Enter note  subject." class="form-control"> 
            <div class="col-md-6">
       </div>
       <div id="country_list"></div> 
       <br>

       <div class="row">

                               <div class="col-md-6">
                                <label>Type a File Name</label>
                                <input type="text"  name="filename" id="filename" placeholder="Enter file name." class="form-control">                                    </div>  
                                <div class="col-md-6">
                                <label>Note No.</label>
                                <input type="text"  name="noteno" id="noteno" placeholder="Enter note No." class="form-control"> 
                                </div>                     
                        
                              <div id="file_list"></div> 
       </div>
<br>
                <div class="row">
                    <div class="col-lg-12">

                    <button type="submit" class="btn btn-success" name="action" value="Approve">Approved</button>

                     <button type="submit"  class="btn btn-danger" name="action" value="Reject">Rejected</button>

                    <button type="submit" class="btn btn-info" name="action" value="Board">Board</button>

                    <button type="submit" class="btn btn-success" name="action" value="paid">Paid</button>

                    <button type="submit" class="btn btn-warning" name="action" value="Pending">Pending</button>
                    <button type="submit" class="btn btn-info" name="action" value="searchnote">Find note</button>
                    <button type="submit" class="btn btn-success" name="action" value="fileandnote">File & Note No.wise search </button>
                          
                    </div>
                </div>
 

    @elseif(auth()->user()->replace_flow =='1')

        <button type="submit" class="btn btn-warning" name="action" value="Pending">Pending Note List</button>

            
    @else
     @endif
                       
    </form>               
</div>
</div>



            <!-- Add Notice Area End Here -->
            <!-- All Notice Area Start Here -->
    <table id="example" class="table table-bordered table-hover" cellspacing="0" style="font-size:12px">

        <thead>
            <tr>
                <th>#</th>   
                <th>Department</th>  
                <th>File NO.</th>
                <th>File Name</th>
                <th>Note NO.</th>  
                <th>Sub Note NO.</th>     
                <th>Note Heading</th>             
                <th>Created by</th>
                <th>Pending Now</th>
                <th>Time Duration</th>
                <th width="20%">Action</th>
            </tr>
        </thead>
        <tbody>


    @foreach ($notelistall as $request)
        <tr>
             @php
                 $datetime1 = new DateTime($request->updated_at);
                $datetime2 = new DateTime(now());
                $interval = $datetime1->diff($datetime2);

                 $days = $interval->format(' %a days %h hours %i minutes '); 

             @endphp
            <td>{{  $loop->index+1 }} </td>
            <td>{{ $request->department }}</td>
            <td>{{ $request->year }}</td> 
             <td>{{ $request->filename }}</td> 
            <td>{{ $request->note_no }}</td>

            @if($request->subnote!='' )
            <td>{{ $request->note_no }}.{{ $request->subnote }}</td>
                        @else
                        <td></td>
            @endif
             <td>{{ $request->name }}</td> 
            
             <td> {{ $request->created_by }} </td>
            @if( $FilterType!='fileandnote')
                        
                            @if($request->status=='')
                            <td> {{ $request->pending_name }} </td>
                            @else
                            <td></td>
                            @endif
                   
                             
                               
            @else
                <td></td>    
            @endif
                 
             @if($request->status=='Approved'||$request->status=='Rejected')
             <td></td>
             @else
                <td>{{$days}}</td>
             @endif
             <td> 
             <a title="View" href="{{ route('outbox.edit', $request->id) }}"
                        class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a>
             <a title="Report" href="{{ route('note.report', $request->id) }}"
                 class="btn btn-info" target='_blank'><i class="fa fa-print"></i></a>
  
             <a title="edit" href="{{ route('module.approvaledit', $request->id) }}"
                        class="btn btn-info"><i class="fa fa-edit"></i></a>

             </td>
            
        </tr>
    @endforeach



    </tbody>
    </table>


    
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
            $(document).ready(function () {
             
                $('#notesubject').on('keyup',function() {
                    var query = $(this).val(); 
                    $.ajax({
                       
                        url:"{{ route('search.note') }}",
                  
                        type:"GET",
                       
                        data:{'notesubject':query},
                       
                        success:function (data) {
                          
                            $('#country_list').html(data);
                        }
                    })
                    // end of ajax call
                });

                
                $(document).on('click', 'li', function(){
                  
                    var value = $(this).text();
                    $('#notesubject').val(value);
                    $('#country_list').html("");
                });
            });
        </script>


</script>
@endsection
