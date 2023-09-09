<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8" />
    <title>File  Report</title>
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
                                                
                        <label for="name">ফাইলের নাম: </label>
                        {{ $file->file_name }}
                         <br>
                         <label for="name">ফাইল নং : </label>
                        {{ $file->file_no }}
                     <br>
                   
                                                   
            @foreach ($notes as $note)   
     
            <label for="name">(নোট {{ $loop->index + 1 }})বিষয় :</label>
                        <u>{{ $note->name }}</u> 
                        <br>
                        @php 
                     $filedesc= $note->description ;

                        @endphp
                     @if($filedesc)
                            <label for="name">নোট বিবরণ : </label>
                        {{ $note->description }}
                     @endif
                        <p> {!! $note->month !!} </p>
                                                   
                        <p align="left">
                        {{ $note->created_name }},
                        {{ $note->designame }} <br>
                        {{ \Carbon\Carbon::parse($note->updated_at)->format('d/m/Y')}} 
                        </p>    
                        
                        @foreach ($querylist as $query)

                            @if ($query->note_id == $note->id) 

                            @if ($query->send_to == $note->created_by)
                            <label for="name"><b>Query :</b> </label> {{ $query->sending_person }}:{{ $query->query_question }} <br>
                                   {{ $query->sendto_person }}:{{ $query->query_answer }}
                            @endif
                            @endif 
                        @endforeach
                                    
                @foreach ($remarklist as $remark) 
                    @if ($remark->id == $note->id) 
                            @if($remark->remarks !='')
                                {{ $remark->remarks }} <br>
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

                       
                                @if ($query->note_id == $note->id)   
                                
                             
                                   @if ($query->send_to == $remark->subject_id)

                              
                                   <label for="name"><b>Query :</b> </label> {{ $query->sending_person }}:{{ $query->query_question }} <br>
                                   {{ $query->sendto_person }}:{{ $query->query_answer }}
                                   @endif
                                   @endif
                                   
                                   <br>
                                   
                        @endforeach
                                                                              
                @endif
                    
            @endforeach


        @foreach ($subnotes as $subnote) 
            
            @if ($subnote->note_no == $note->note_no) 

        
            <label for="name">(উপ নোট {{ $subnote->subnote }})বিষয় :</label>
                        <u>{{ $subnote->name }}</u> 
                        <br>
                        @php 
                     $filedesc= $subnote->description ;

                        @endphp
                     @if($filedesc)
                            <label for="name">নোট বিবরণ : </label>
                        {{ $subnote->description }}
                     @endif
                        <p> {!! $subnote->month !!} </p>
                                                   
                        <p align="left">
                        {{ $subnote->created_name }} ,
                        {{ $subnote->designame }} <br>
                        {{ \Carbon\Carbon::parse($subnote->updated_at)->format('d/m/Y')}} 
                        </p> 
                                                      
                                    
                @foreach ($remarklist as $remark) 
                    @if ($remark->id == $subnote->id) 
                            @if($remark->remarks !='')
                                {{ $remark->remarks }} <br>
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

                       
                                @if ($query->note_id == $subnote->id)   
                                
                             
                                   @if ($query->send_to == $remark->subject_id)

                              
                                   <label for="name"><b>Query :</b> </label> {{ $query->sending_person }}:{{ $query->query_question }} <br>
                                   {{ $query->sendto_person }}:{{ $query->query_answer }}
                                   @endif
                                   @endif
                                   
                                   <br>
                                   
                        @endforeach
                                                                              
                    @endif
                    
                    
               @endforeach
            @endif
        @endforeach
                                     
                                                                                      
@endforeach                       
                                
    </div>
    <!-- <div class="page-break"></div>
    @foreach ($notes as $note) 
        <img src="{{ $note->file_path }}"  />
        
    @endforeach   -->
</body>
</html>
