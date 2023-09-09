@extends('layout.master')
@section('content')
    <!-- Breadcubs Area Start Here -->
    
    <div class="col-lg-12">


    <form action="{{ route('module.close') }}" method="POST">
     @csrf
     <div class="form-group">
        <table id="example" class="table table-bordered table-hover" cellspacing="0" style="font-size:12px">

          <thead>
                <tr>
                    <th>Approval Flow</th>                  
                </tr>
        </thead>
            <tbody>
                @foreach ($approvallist as $module)
                    <tr>
                         <td>
                        <h6> {{ $loop->index + 1 }} . {{ $module->name }}</h6>                     
                        </td>   
                    </tr>
                @endforeach

            </tbody>
        </table> 
         <div class="modal-footer">
         <button type="submit" class="btn btn-primary btn-xs"> close</button>
        </div>
    </div>
 </form>
</div>
@endsection

