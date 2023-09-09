<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8" />
    <title>Note Report</title>
    <style>
       

        html, body, div {
      font-family: nikosh;
    }


        span {
            font-size: 1.3em;
        }
        table, td, th {
  border: 0px solid black;
}
.page-break {
    page-break-after: always;
}

table {
  width: 100%;
  border-collapse: collapse;
}

        .styled-table {
            border-collapse: collapse;
            font-size: 0.9em;
            font-family: sans-serif;
            min-width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);

            border: .5px solid black;
            border-collapse: collapse;
        }
        .styled-table thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
        }
        .styled-table th,
        .styled-table td {
            padding: 12px 15px;
        }
        .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }
        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }
        .styled-table tbody tr:last-of-type {
            border-bottom: 1px solid #009879;
        }
        .styled-table tbody tr.active-row {
            font-weight: bold;
            /* color: #009879; */
            color: black;
        }
        /* * {
            box-sizing: border-box;
        } */
        .table-border {
            border: 1px solid black;
            border-collapse: collapse;
        }
        table.border-right {
            border-collapse: collapse;
        }
        .border-right>tr {
            border: none;
        }
        .border-right>td:nth-child(1) {
            border-right: solid 1px black;
        }



    </style>
</head>

<body>
    <div class="invoice-box">
   
   
    <h2 style="text-align:center"> <u>"নোট শীট" </u></h2>
  <br>                                  
    @foreach ($module as $module)   
   
    
            @if($module->subnote=='')

                                                    <label for="name">ফাইলের নাম: </label>
                                                    {{ $module->filename }}
                                                    <label for="name">নোট নং: </label>
                                                     {{$module->note_no}}
                                                    <br>
                                                                            
                                                    <label for="name">বিষয় :</label>
                                                   <u> {{ $module->name }}</u>
                                                    <br>
                                                  @php 
                                                  $filedesc= $module->description ;

                                                  @endphp
                                                  @if($filedesc)
                                                  <label for="name">নোট বিবরণ : </label>
                                                  {{ $module->description }}
                                                  @endif

                            <p> {!! $module->month !!} 
                            
                            <p align="left"> @if($module->signature_file_path!=='') 
                                <img src="{{ $module->signature_file_path }}"  /> 
                                @else
                                @endif
                                
                                <br> {{ $module->created_name }},
                            {{ $module->designame }}   <br>                         
                            {{ \Carbon\Carbon::parse($module->updated_at)->format('d/m/Y')}} </p>
                            
                            @foreach ($querylist as $query)

                            @if ($query->note_id == $module->id) 

                            @if ($query->send_to == $module->created_by)
                            <label for="name"><b>Query :</b> </label> {{ $query->sending_person }}:{{ $query->query_question }} <br>
                                   {{ $query->sendto_person }}:{{ $query->query_answer }}
                            @endif
                            @endif 
                            @endforeach
            <br>

            <br>
                @foreach ($remarklist as $remark) 
                    @if ($remark->id == $module->id) 
                            @if($remark->remarks !='')
                                {{ $remark->remarks }} <br>
                                @if($remark->signature_file_path!=='')
                                <img src="{{ $remark->signature_file_path }} "  />
                                @else
                                @endif
                                <br>
                                            <b>{{ $remark->name }}</b> ,
                                            {{ $remark->designame }} <br>
                                        {{ \Carbon\Carbon::parse($remark->updated_at)->format('d/m/Y')}}
                                        
                                        @if($remark->file_name!='')
                                        
                                        <div class="page-break"></div>
                                        <img src="{{ $remark->file_path }}"  />
                                        <div class="page-break"></div>
                                        @endif

                            @endif         
                                <br>
                        @foreach ($querylist as $query)

                       
                                @if ($query->note_id == $module->id)   
                                
                             
                                   @if ($query->send_to == $remark->subject_id)

                              
                                   <label for="name"><b>Query :</b> </label> {{ $query->sending_person }}:{{ $query->query_question }} <br>
                                   {{ $query->sendto_person }}:{{ $query->query_answer }}
                                   @endif
                                   @endif
                                   
                                   <br>
                                   
                        @endforeach
                                                                              
                    @endif
                    
                 @endforeach
<br>
        @else
     
              <label for="name">নোট নং: </label>
              {{$module->note_no}} <br>
            <label for="name">(উপ নোট নং: {{ $module->subnote }})বিষয় :</label>
                        <u>{{ $module->name }}</u> 
                        <br>
                        @php 
                     $filedesc= $module->description ;

                        @endphp
                     @if($filedesc)
                            <label for="name">নোট বিবরণ : </label>
                        {{ $module->description }}
                     @endif
                        <p> {!! $module->month !!} </p>
                                                   
                        <p align="left">
                        {{ $module->created_name }} ,
                        {{ $module->designame }} <br>
                        {{ \Carbon\Carbon::parse($module->updated_at)->format('d/m/Y')}} 
                        </p>    

                                    
                @foreach ($remarklist as $remark) 
                    @if ($remark->id == $module->id) 
                            @if($remark->remarks!='')
                            {{ $remark->remarks }} <br>
                                        <b>{{ $remark->name }}</b>,
                                        {{ $remark->designame }} <br>
                                    {{ \Carbon\Carbon::parse($remark->updated_at)->format('d/m/Y')}}  

                                     @if($remark->file_name!='')
                               
                                     <div class="page-break"></div>
                                    <img src="{{ $remark->file_path }}"  /> 
                                    <div class="page-break"></div>
                               @endif
                                        <br> 

                                @foreach ($querylist as $query)
                                        @if ($query->note_id == $module->id)                                       
                                        @if ($query->send_to == $remark->subject_id)
                                        <label for="name"><b>Query :</b> </label> {{ $query->sending_person }}:{{ $query->query_question }} <br>
                                        {{ $query->sendto_person }}:{{ $query->query_answer }}
                                        @endif
                                        @endif
                                        
                                        <br>
                                        
                                @endforeach
                                                                                
                            @endif
                    @endif
               @endforeach
            
          
       @endif

    @endforeach                      
                                
    </div>
    @php
    $file= $module->file_name ;
    @endphp
    @if($file)
        @if(pathinfo($file, PATHINFO_EXTENSION)!='pdf')
        <div class="page-break"></div>
        <img src="{{ $module->file_path }}"  />
        @else
        @endif
    @endif

    


</body>
</html>
