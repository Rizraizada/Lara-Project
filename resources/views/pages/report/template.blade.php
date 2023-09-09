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
     <div>
         <p> {!! $template->template_details !!}                                                                                   
    </div>

    
  
   

  
</body>
</html>
