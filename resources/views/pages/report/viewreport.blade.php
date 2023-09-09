@extends('layout.master')
@section('content')


<div class="row">   
                        <div class="heading-layout1">
                            <h3 class="page-header">Reports
                                
                            </h3>
                            
                           
                        </div>  
                </div>

    <!-- Breadcubs Area Start Here -->
            <form action="{{ route('report.view') }}" method="POST" enctype="multipart/form-data" target="_blank">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                           <div class="form-group">

                                <label>Type a File No.</label>
                                <input type="text" name="country" id="country" placeholder="Enter file no." class="form-control"> 
                            </div> 
                            <div id="country_list"></div> 
                            <div class="form-group">
                                <label>Type a File Name</label>
                                <input type="text" name="filename" id="filename" placeholder="Enter file name." class="form-control">                                    
                            </div>                       
                        
                                <div id="file_list"></div> 
                             
                    </div>
                    <div class="modal-footer">                          
                            
                             <button type="submit" class="btn btn-primary"> <i class="fa fa-print" aria-hidden="true"></i></button>
                           
                    </div> 
                    
                </div> 
                   
                               
            </form>

@endsection
@section('scripts')
<script type="text/javascript">
            $(document).ready(function () {
             
                $('#country').on('keyup',function() {
                    var query = $(this).val(); 
                    $.ajax({
                       
                        url:"{{ route('search.report') }}",
                  
                        type:"GET",
                       
                        data:{'country':query},
                       
                        success:function (data) {
                          
                            $('#country_list').html(data);
                        }
                    })
                    // end of ajax call
                });

                
                $(document).on('click', 'li', function(){
                  
                    var value = $(this).text();
                    $('#country').val(value);
                    $('#country_list').html("");
                });
            });
        </script>

<script type="text/javascript">
            $(document).ready(function () {
             
                $('#filename').on('keyup',function() {
                    var query = $(this).val(); 
                    $.ajax({
                       
                        url:"{{ route('searchbyfile.report') }}",
                  
                        type:"GET",
                       
                        data:{'filename':query},
                       
                        success:function (data) {
                          
                            $('#file_list').html(data);
                        }
                    })
                    // end of ajax call
                });

                
                $(document).on('click', 'li', function(){
                  
                    var value = $(this).text();
                    $('#filename').val(value);
                    $('#file_list').html("");
                });
            });
        </script>
@endsection