@extends('layout.master')
@section('content')
    <!-- Breadcubs Area Start Here -->
    
    <div class="col-lg-12">
       
                                        <form action="{{ route('outbox.close') }}" method="POST">
                                            @csrf
                                            <div>
                                        <label for="fabricBox">From</label>
                                        <select name="from[]" id="fabricBox" class="form-control" size="8" multiple="multiple" style="width:100%">
                                          <option>Fabric 1</option>
                                          <option>Fabric 2</option>
                                          <option>Fabric 3</option>
                                          <option>Fabric 4</option>
                                          <option>Fabric 5</option>
                                          <option>Fabric 6</option>
                                        </select>
                                        <button id="move">Move Selected</button>
                                      </div>
                                      <br/>
                                      <div>
                                        <label for="fabricBox_to">To</label>
                                        <select name="to[]" id="fabricBox_to" class="form-control" size="8" multiple="multiple" style="width:100%" required>
                                        </select>
                                        <button id="moveBack">Move Selected back</button>
                                      </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="footer-btn bg-linkedin"> save</button>
                                            </div>
                                        </form>
                    

    </div>
@endsection
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.1/css/select2.min.css" />
@endsection
@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">
	$("#move").on("click", function(){
  MoveToandFrom("#fabricBox", "#fabricBox_to");
});

//You can even move the options back if you need to
$("#moveBack").on("click", function(){
  MoveToandFrom("#fabricBox_to", "#fabricBox");
});

//reusable function that moves selected indexes back and forth
function MoveToandFrom(fromSelectElement, toSelectElement)
{
  //get list of selected options as delimited string
  var selected = $(fromSelectElement + " option:selected").map(function(){ return this.value }).get().join(", ");
  
  //if no option is selected in either select box
  if( $.contains(selected, "") ){
    alert("You have to select an option!");
    return false;
  }
  
  //split the selected options into an array 
  var stringArray = selected.split(',');
   
  //remove selected items from selected select box to second select box
  $(fromSelectElement + " option:selected").remove();
   
  //loop through array and append the selected items to Fabric_to select box
  $.each( stringArray, function( key, value ) {
      $(toSelectElement).append("<option>" + value + "</option>");
  });
}
</script>
@endsection
