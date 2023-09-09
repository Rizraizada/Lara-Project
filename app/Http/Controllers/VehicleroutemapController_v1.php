<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Road;
use App\Models\User;
use App\Models\vehicledriver;
use App\Models\Vehicleroutemap;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VehicleroutemapController extends Controller
{
    //

    public function index()

    {
        


        $data['items']=DB::table('vehicleroutemaps')
        ->select('vehicleroutemaps.id','driver_info.driver_name','items.item_name  as vehicle_name',
        'vehicleroutemaps.period_from','vehicleroutemaps.period_to' ,'vehicleroutemaps.vehicle_id','vehicleroutemaps.vehicle_driver_id'
        ,'roads.Road_name','vehicleroutemaps.user_desc','vehicleroutemaps.prosthan','vehicleroutemaps.agomon','vehicleroutemaps.remarks'
        ,'vehicleroutemaps.username as username','vehicleroutemaps.created_at','vehicleroutemaps.start_from','users.name as created_by')
        ->join('items','vehicleroutemaps.vehicle_id','=','items.id')
        ->join('driver_info', 'vehicleroutemaps.vehicle_driver_id', '=', 'driver_info.id')
        ->join('roads','vehicleroutemaps.start_from','=','roads.id')
        ->join('users','vehicleroutemaps.created_by','=','users.id')
        ->paginate(30);


    

        $data['vehicles'] =Item::all();
        $data['routes']=Road::all();

        $data['users']=User::all();

        $data['drivers'] =DB::table('driver_info')->get();


    return view('pages.vehicleroutemap.index',$data);
    
    }


    public function store(Request $request)

    {
         

            $item=new Vehicleroutemap();
            $item->vehicle_id=$request->vehicleid;
            $item->vehicle_driver_id=$request->driverid;
            $item->username=$request->userid;
            $item->start_from=$request->routeid;
            $item->end_point=$request->destid;
            $item->period_from=$request->initiatetime;
            $item->period_to=$request->reachtime;
            $item->prosthan=$request->initiatekm;
            $item->agomon=$request->reachkm;
            $item->meterriding=$request->reachkm;
            $item->remarks=$request->remarks;
            $item->user_desc=$request->use_desc;
            $item->created_by=Auth::user()->id;
            $item->save();
   
            return back()->with('success','Vehicle Route Map  has been saved.');

    }

    public function update(Request $request, $id)
    {

            $item = Vehicleroutemap::find($id);

            $item->vehicle_id=$request->vehicleid;
            $item->vehicle_driver_id=$request->driverid;
            $item->username=$request->userid;
            $item->start_from=$request->routeid;
            $item->prosthan=$request->initiatekm;
            $item->agomon=$request->reachkm;
            $item->meterriding=$request->reachkm;
            $item->user_desc=$request->use_desc;
            $item->updated_by=Auth::user()->id;

            if($request->initiatetime !="" &&$request->reachtime !="")
            {

                $item->period_from=$request->initiatetime;
                $item->period_to=$request->reachtime;
                $item->save();
            }
            $item->save();
   
            return redirect()->route('vehicleroutemap.entry')->with('success','Data has been updated.');

       
    }


    public function filtering(Request $request)
    {
      $vehicleid=$request->vehicleid;
        $monid=$request->monid;
        $yr=$request->yr;
      
   
       
       if($monid!='' && $yr!='')
       
       {

    
                $data['items']=DB::table('vehicleroutemaps')
                ->select('vehicleroutemaps.id','driver_info.driver_name','items.item_name  as vehicle_name',
                'vehicleroutemaps.period_from','vehicleroutemaps.period_to' ,'vehicleroutemaps.vehicle_id','vehicleroutemaps.vehicle_driver_id'
                ,'roads.Road_name','vehicleroutemaps.user_desc','vehicleroutemaps.prosthan','vehicleroutemaps.agomon','vehicleroutemaps.remarks'
                ,'vehicleroutemaps.username as username','vehicleroutemaps.created_at','vehicleroutemaps.start_from','users.name as created_by')
                ->join('items','vehicleroutemaps.vehicle_id','=','items.id')
                ->join('driver_info', 'vehicleroutemaps.vehicle_driver_id', '=', 'driver_info.id')
                ->join('roads','vehicleroutemaps.start_from','=','roads.id')
                ->join('users','vehicleroutemaps.created_by','=','users.id')
                ->where('vehicleroutemaps.vehicle_id',$vehicleid)
                ->whereMonth('period_from', $monid)
                ->whereYear('period_from', $yr)
                ->where('vehicleroutemaps.vehicle_id',$vehicleid)
                ->get();

                $data['vehicles'] =Item::all();
                $data['routes']=Road::all();

                $data['users']=User::all();

                $data['drivers'] =DB::table('driver_info')->get();

                $sumprosthan=DB::table('vehicleroutemaps')
                ->where('vehicleroutemaps.vehicle_id',$vehicleid)
                ->whereMonth('period_from', $monid)
                 ->whereYear('period_from', $yr)
                ->sum('prosthan');
        
                $sumagomon=DB::table('vehicleroutemaps')
                ->where('vehicleroutemaps.vehicle_id',$vehicleid)
                ->whereMonth('period_from', $monid)
                 ->whereYear('period_from', $yr)
                ->sum('agomon');
        
            
                $data['totalkm']=   $sumagomon- $sumprosthan;

                return view('pages.vehicleroutemap.filter',$data);

       }


       else
       {

        $data['items']=DB::table('vehicleroutemaps')
        ->select('vehicleroutemaps.id','driver_info.driver_name','items.item_name  as vehicle_name',
        'vehicleroutemaps.period_from','vehicleroutemaps.period_to' ,'vehicleroutemaps.vehicle_id','vehicleroutemaps.vehicle_driver_id'
        ,'roads.Road_name','vehicleroutemaps.user_desc','vehicleroutemaps.prosthan','vehicleroutemaps.agomon','vehicleroutemaps.remarks'
        ,'vehicleroutemaps.username as username','vehicleroutemaps.created_at','vehicleroutemaps.start_from','users.name as created_by')
        ->join('items','vehicleroutemaps.vehicle_id','=','items.id')
        ->join('driver_info', 'vehicleroutemaps.vehicle_driver_id', '=', 'driver_info.id')
        ->join('roads','vehicleroutemaps.start_from','=','roads.id')
        ->join('users','vehicleroutemaps.created_by','=','users.id')
        ->where('vehicleroutemaps.vehicle_id',$vehicleid)
        ->get();

        $data['vehicles'] =Item::all();
        $data['routes']=Road::all();

        $data['users']=User::all();

        $data['drivers'] =DB::table('driver_info')->get();



        $sumprosthan=DB::table('vehicleroutemaps')
        ->where('vehicleroutemaps.vehicle_id',$vehicleid)
        ->sum('prosthan');

        $sumagomon=DB::table('vehicleroutemaps')
        ->where('vehicleroutemaps.vehicle_id',$vehicleid)
        ->sum('agomon');

    
        $data['totalkm']=   $sumagomon- $sumprosthan;

   
    
       


        return view('pages.vehicleroutemap.filter',$data);

       }
    }


}
