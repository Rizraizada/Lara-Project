@extends('layout.master')
@section('content')
    <!-- Breadcubs Area Start Here -->
    
    <div class="col-lg-12">


    <form action="{{ route('module.approvalupdate', $approval->id) }}" method="POST">
     @csrf
                 <div class="form-group">
                    <div class="row">
                    <div class="col-md-9">
                         <label>Previous Person:</label>
                            {{$participant->name}}
                        </div>

                        <div class="col-md-9">
                         <label>Select New Person</label>
                            <select class="form-control" data-skip-name="true"
                                 data-name="subject[]" name="subject[]">
                                     <option value="">Select</option>
                                         @foreach ($subjectList as $subject)
                                            <option value="{{ $subject->id }}">
                                                     {{ $subject->name }}(
                                                    {{$subject->designame}},{{$subject->deptname}})</option>
                                         @endforeach
                            </select>
                        </div>
                                                          
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"> Replace</button>
                </div>
                                           
    </form>
</div>
@endsection

