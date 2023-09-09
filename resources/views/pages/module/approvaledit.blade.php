@extends('layout.master')
@section('content')
    <!-- Breadcubs Area Start Here -->
    
    <div class="col-lg-12">
    @if ($message = Session::get('success'))
                                            <div class="alert alert-success">
                                                <strong>{{ $message }}</strong>
                                            </div>
      @endif
        <form action="{{ route('outbox.close') }}" method="POST">
         @csrf
            <div class="form-group">
                 <div class="row">
                        <div class="col-md-6 text-info">
                                                 <label for="name">File Name</label>
                                                <input type="text" id="name" class="form-control mb-3"
                                                    placeholder="Name" name="module_name"
                                                value="{{ $module->filename }}" readonly>
                        </div>

                        <div class="col-md-6 text-info">
                                                    <label for="name">Note Heading</label>
                                                    <input type="text" id="name" class="form-control mb-3"
                                                        placeholder="Name" name="module_name"
                                                        value="{{ $module->name }}" readonly>
                        </div>
                </div>    
                                              
                        <div class="col-md-12 text-info ">
                                            <label for="month">Note Details</label>
                                                
                                            <textarea class=" ckeditor form-control "  id="module_description" name="module_description"  readonly>{{ $module->month }}                               
                                                </textarea>

                        </div>
                                        <br>
                        <div class="col-md-12">

                        @if($module->file_name!='')
                                                
                        <a href="<?php echo asset("/images/".$module->file_name) ?>" target="_BLANK"><i class='fa fa-download'> </i> Downlaod Attachment </a>
                                            
                         @endif
                                                
                        </div>
                        <br>
                <table class="table table-bordered table-hover" cellspacing="0" style="font-size:12px">
                                                    
                <thead>
                <tr>
                 <th scope="col">#</th>
                                <th scope="col">Approval Name</th>
                                <th scope="col">Remarks</th>
                                          
                             </tr>
                            </thead>
                        <tbody> 
                    <tbody>
                 @foreach ($remarklsit as $remark)
@if($remark->flag==1)
                                                           
        <tr>
            <td>{{ $loop->index + 1 }}</td>


             <td bgcolor="#06802d"> <font color="#fff"> {{ $remark->name }}</font>  </td>
             <td> {{ $remark->remarks }}   </td>
      
        </tr> 
                                                       
@else 
                                                        
     <tr> 
        <td>{{ $loop->index + 1 }}</td>


        <td  bgcolor="#c90e1e">  <font color="#0d0d0d"> {{ $remark->name }} </font> </td>
        <td> 
        {{ $remark->remarks }} 

        </td> 

        <td>  

        <a title="Leave" href="{{ route('module.editflow', $remark->id) }}"
                        class="btn btn-info"><i class="fa fa-edit" aria-hidden="true"></i></a>   
                    
   </td>
                                                            
</tr>
                                                            
     @endif
    @endforeach
    </tbody>
 </table>
            </div>
             <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"> Close</button>
             </div>
        </form>
                    

    </div>
@endsection


