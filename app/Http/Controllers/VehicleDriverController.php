<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\vehicledriver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehicleDriverController extends Controller
{
    //

    public function index()

    {

        $data['items']=DB::table('vehicledrivers')
        ->select('vehicledrivers.id','driver_info.driver_name','items.item_name  as vehicle_name',
        'vehicledrivers.duration_from','vehicledrivers.duration_to' ,'vehicledrivers.vehicle_id','vehicledrivers.vehicle_driver_id')
        ->join('items','vehicledrivers.vehicle_id','=','items.id')
        ->join('driver_info', 'vehicledrivers.vehicle_driver_id', '=', 'driver_info.id')
        ->orderBy('vehicle_name', 'asc')
        ->paginate(30);

        $data['vehicles'] =Item::all();

        $data['drivers'] =DB::table('driver_info')->get();


    return view('pages.vehicledriver.index',$data);
    
    }


    public function store(Request $request)

    {
         

            $item=new vehicledriver();
            $item->vehicle_id=$request->vehicleid;
            $item->vehicle_driver_id=$request->driverid;
            $item->duration_from=$request->initiate;
            $item->duration_to=$request->expired;
            $item->save();
   
            return back()->with('success','Vehicle Driver  has been saved.');

    }

    public function update(Request $request, $id)
    {

            $item = vehicledriver::find($id);


            $item->vehicle_id=$request->vehicleid;
            $item->vehicle_driver_id=$request->driverid;

            if($request->initiate!='' ||  $request->expired!='')
            {  $item->duration_from=$request->initiate;
                $item->duration_to=$request->expired;}
          
            $item->save();

            return redirect()->route('vehicledriver.entry')->with('success','Data has been updated.');

            //return back()->with('success','Data has been updated.');
       
    }


    public function filtering(Request $request)
    {
       $vehicleid=$request->vehicleid;
       


       $data['items']=DB::table('vehicledrivers')
       ->select('vehicledrivers.id','driver_info.driver_name','items.item_name  as vehicle_name',
       'vehicledrivers.duration_from','vehicledrivers.duration_to' ,'vehicledrivers.vehicle_id','vehicledrivers.vehicle_driver_id')
       ->join('items','vehicledrivers.vehicle_id','=','items.id')
       ->join('driver_info', 'vehicledrivers.vehicle_driver_id', '=', 'driver_info.id')
       ->where('vehicledrivers.vehicle_id',$vehicleid)
       ->get();

       $data['vehicles'] =Item::all();

       $data['drivers'] =DB::table('driver_info')->get();


      
                return view('pages.vehicledriver.filter',$data);

        }






}
