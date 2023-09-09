<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Road;
use App\Models\vehicleRouteTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class vehicleroutetimecontroller extends Controller
{
    
    public function index()

    { 
        $data['items']=DB::table('vehicle_route_times')
        ->select('vehicle_route_times.id','vehicle_route_times.vehicle_id','vehicle_route_times.up_trip_start_time','vehicle_route_times.up_trip_end_time',
        'vehicle_route_times.down_trip_start_time','vehicle_route_times.down_trip_end_time','vehicle_route_times.up_trip_start'
        ,'vehicle_route_times.up_trip_end','vehicle_route_times.down_trip_start','vehicle_route_times.down_trip_end','items.item_name as vehicle_name')
        ->join('items','vehicle_route_times.vehicle_id','=','items.id')
        ->get();


         $data['vehicles'] =Item::all();
         $data['routes']=Road::all();


        return view ('pages.vehicleroutetime.index',$data);
    }

    public function store(Request $request)

    {
         

            $item=new vehicleRouteTime();
            $item->vehicle_id=$request->vehicleid;

            $item->up_trip_start_time=$request->initiatetime;
            $item->up_trip_end_time=$request->reachtime;
            $item->down_trip_start_time=$request->downinitiatetime;
            $item->down_trip_end_time=$request->downreachtime;
            $item->up_trip_start=$request->upstart;
            $item->up_trip_end=$request->uptripend;
            $item->down_trip_start=$request->downstart;
            $item->down_trip_end=$request->downtripend;

            $item->save();
   
            return back()->with('success','Vehicle Route & Time  has been saved.');

    }
      public function update(Request $request, $id)
    {

            $item = vehicleRouteTime::find($id);

            $item->vehicle_id=$request->vehicleid;
            $item->up_trip_start=$request->upstart;
            $item->up_trip_end=$request->uptripend;
            $item->down_trip_start=$request->downstart;
            $item->down_trip_end=$request->downend;
        

            if($request->initiatetime !="" || $request->reachtime !="" || $request->downinitiatetime !=""|| $request->downreachtime !="")
            {

               
                $item->up_trip_start_time=$request->initiatetime;
                $item->up_trip_end_time=$request->reachtime;
                $item->down_trip_start_time=$request->downinitiatetime;
                $item->down_trip_end_time=$request->downreachtime;
                $item->save();
            }
            $item->save();
   
            return redirect()->route('vehicleroutetime.entry')->with('success','Data has been updated.');

       
    }
}
