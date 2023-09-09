<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>
</head>
<body>

    <h1 align="center">Transportation Cost Report</h1>
 
    <p align="center">Year:{{$year}}  Month: @if  ($mon=='10')
        October @elseif  ($mon=='11') November @elseif  ($mon=='12') December 
        @elseif  ($mon=='1') January @elseif  ($mon=='2') February @elseif  ($mon=='3') March
        @elseif  ($mon=='4') April @elseif  ($mon=='5') May @elseif  ($mon=='6') June
        @elseif  ($mon=='7') July @elseif  ($mon=='8') August @elseif  ($mon=='9')September 
        @else
        @endif</p> 
    

 <p>Print Date: {{ \Carbon\Carbon::now()->format('m/d/Y') }}</p> 



		<table border="0" width="100%" >
            <thead class="thead-dark">
                            <tr>
                                {{-- <th>Item Id</th> --}}
                                <th style="height:60px">#</th>
                                <th>Vehcile Name </th>
                                <th> Distance (KM)</th>
                                <th>Total Oil (Litre)</th>
                        <th>Total Gas (Litre)</th>
                        <th>Total Fuel Consumed</th>
                        <th> Distance Covered in km(Per Litre) </th>
                            
                            </tr>
            </thead>
            <tbody>
                @foreach ($totaldistance as $distance)
                    <tr>
                        <td>{{$loop->index+1 }} </td>
                        <td>{{ $distance->vehicle_name }}</td>
                        <td>{{$distance->distance_covered}}</td>


                                    @foreach ($fuel_info_oil as $fuel)

                                                @if($fuel->vehicleId==$distance->vehicle_id)

                                                       
                                                            @if($fuel->fuelType==1)
                                                                <td style="height:60px">               
                                                                    {{$fuel->total}}
                                                                </td>
                                                            @else
                                                                 <td style="height:60px"> </td>
                                                            @endif 
                                                       
                                               
                                                @endif

                                    @endforeach

                                     @foreach ($fuel_info_gas as $fuel)

                                        @if($fuel->vehicleId==$distance->vehicle_id)

                                                            @if($fuel->fuelType==2)
                                                                <td style="height:60px">               
                                                                    {{$fuel->total}}
                                                                </td>
                                                            @else
                                                                 <td style="height:60px"> </td>
                                                            @endif 
                                       
                                        
                                        @endif   

                                     @endforeach

                                     @foreach ($fuel_info_all as $fuels)
                                        
                                        @if($fuels->vehicleId==$distance->vehicle_id)
                                            <td style="height:60px">{{$fuels->total}}</td>
                                        @endif

                                        
                                    @endforeach



                                     @foreach ($fuel_info_all as $fuels)

                                             @if($fuels->vehicleId==$distance->vehicle_id)
                                                    
                                     
                                                
                                                    @if($fuels->total!=0)
                                                        <td style="height:60px">
                                                        {{ number_format($distance->distance_covered /  $fuels->total,2)}}
                                                        </td> 
                                                    @endif
                                              
                                                            
                                           

                                            
                                             @endif
                                    @endforeach


                        </tr>
                    @endforeach

                </tbody>
				
			</table>
		


</body>
</html>