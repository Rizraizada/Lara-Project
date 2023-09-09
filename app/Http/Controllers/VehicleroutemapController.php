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
use PDF;
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

 public function reportview(Request $request)

    {


        $monid=$request->monid;
        $yr=$request->yr;

        $data['year']=$yr;
        $data['mon']=$monid;


        
        // echo $monid;
        // exit;
        
        if($monid=="" &&$yr=="")
        {
            $data['fuel_info_gas'] = DB::table('fuelgas')
            ->select('vehicleId','items.item_name  as vehicle_name','fuelType', DB::raw('sum(totalUnit) as total'))
            ->join('items','fuelgas.vehicleId','=','items.id')
            ->groupBy('vehicleId','fuelType','items.item_name')
            ->where('fuelgas.fuelType',2)
            ->get();


            
            $data['fuel_info_oil'] = DB::table('fuelgas')
            ->select('vehicleId','items.item_name  as vehicle_name','fuelType', DB::raw('sum(totalUnit) as total'))
            ->join('items','fuelgas.vehicleId','=','items.id')
            ->groupBy('vehicleId','fuelType','items.item_name')
            ->where('fuelgas.fuelType',1)
            ->get();

            $data['fuel_info_all'] = DB::table('fuelgas')
            ->select('vehicleId','items.item_name  as vehicle_name', DB::raw('sum(totalUnit) as total'))
            ->join('items','fuelgas.vehicleId','=','items.id')
            ->groupBy('vehicleId','items.item_name')
            ->get();
      

            $data['vehicles'] =Item::all();

            $data['totaldistance'] =  DB::table('vehicleroutemaps')
            ->select('vehicle_id','items.item_name  as vehicle_name',DB::raw('sum(agomon - prosthan) as distance_covered'))
            ->join('items','vehicleroutemaps.vehicle_id','=','items.id')
            ->groupBy('vehicle_id','items.item_name')
            ->get();
        }


        if($monid!="" && $yr!="")
        {

            $data['fuel_info_gas'] = DB::table('fuelgas')
            ->select('vehicleId','items.item_name  as vehicle_name','fuelType', DB::raw('sum(totalUnit) as total'))
            ->join('items','fuelgas.vehicleId','=','items.id')
            ->groupBy('vehicleId','fuelType','items.item_name')
            ->where('fuelgas.fuelType',2)
            ->whereMonth('fuelgas.fuelDate',$monid)
          ->whereYear('fuelgas.fuelDate', $yr)
            ->get();


            
            $data['fuel_info_oil'] = DB::table('fuelgas')
            ->select('vehicleId','items.item_name  as vehicle_name','fuelType', DB::raw('sum(totalUnit) as total'))
            ->join('items','fuelgas.vehicleId','=','items.id')
            ->groupBy('vehicleId','fuelType','items.item_name')
            ->where('fuelgas.fuelType',1)
            ->whereMonth('fuelgas.fuelDate',$monid)
    ->whereYear('fuelgas.fuelDate', $yr)
            ->get();

            $data['fuel_info_all'] = DB::table('fuelgas')
            ->select('vehicleId','items.item_name  as vehicle_name', DB::raw('sum(totalUnit) as total'))
            ->join('items','fuelgas.vehicleId','=','items.id')
            ->groupBy('vehicleId','items.item_name')
            ->whereMonth('fuelgas.fuelDate',$monid)
    ->whereYear('fuelgas.fuelDate', $yr)
            ->get();
      

            $data['vehicles'] =Item::all();

            $data['totaldistance'] =  DB::table('vehicleroutemaps')
            ->select('vehicle_id','items.item_name  as vehicle_name',DB::raw('sum(agomon - prosthan) as distance_covered'))
            ->join('items','vehicleroutemaps.vehicle_id','=','items.id')
            ->groupBy('vehicle_id','items.item_name')
            ->whereMonth('vehicleroutemaps.period_from',$monid)
            ->whereYear('vehicleroutemaps.period_from', $yr)
            ->get();


        }


        if( $yr!="" && $monid=="")
        {

            $data['fuel_info_gas'] = DB::table('fuelgas')
            ->select('vehicleId','items.item_name  as vehicle_name','fuelType', DB::raw('sum(totalUnit) as total'))
            ->join('items','fuelgas.vehicleId','=','items.id')
            ->groupBy('vehicleId','fuelType','items.item_name')
            ->where('fuelgas.fuelType',2)
         
          ->whereYear('fuelgas.fuelDate', $yr)
            ->get();


            
            $data['fuel_info_oil'] = DB::table('fuelgas')
            ->select('vehicleId','items.item_name  as vehicle_name','fuelType', DB::raw('sum(totalUnit) as total'))
            ->join('items','fuelgas.vehicleId','=','items.id')
            ->groupBy('vehicleId','fuelType','items.item_name')
            ->where('fuelgas.fuelType',1)
           
    ->whereYear('fuelgas.fuelDate', $yr)
            ->get();

            $data['fuel_info_all'] = DB::table('fuelgas')
            ->select('vehicleId','items.item_name  as vehicle_name', DB::raw('sum(totalUnit) as total'))
            ->join('items','fuelgas.vehicleId','=','items.id')
            ->groupBy('vehicleId','items.item_name')
            
    ->whereYear('fuelgas.fuelDate', $yr)
            ->get();
      

            $data['vehicles'] =Item::all();

            $data['totaldistance'] =  DB::table('vehicleroutemaps')
            ->select('vehicle_id','items.item_name  as vehicle_name',DB::raw('sum(agomon - prosthan) as distance_covered'))
            ->join('items','vehicleroutemaps.vehicle_id','=','items.id')
            ->groupBy('vehicle_id','items.item_name')
          
            ->whereYear('vehicleroutemaps.period_from', $yr)
            ->get();


        }


            $pdf = PDF::loadview ('pages.report.vehicledataTest', $data, [], [ 
                'title' => 'Certificate', 
                'format' => 'A4-L',
                'orientation' => 'L'
            ]);
            // $pdf->setPaper('A4', 'landscape');
            $pdf->autoScriptToLang = true;
            $pdf->SetProtection(['copy', 'print'], '', 'pass');
            return $pdf->stream('vehciledata.pdf');
        


    }



    public function report()
    {

        // $vehicleid=$request->vehicleid;
        // $monid=$request->monid;
        // $yr=$request->yr;



        $data['fuel_info_gas'] = DB::table('fuelgas')
        ->select('vehicleId','items.item_name  as vehicle_name','fuelType', DB::raw('sum(totalUnit) as total') ,DB::raw('sum(totalCost) as totalcost'))
        ->join('items','fuelgas.vehicleId','=','items.id')
        ->groupBy('vehicleId','fuelType','items.item_name')
        ->where('fuelgas.fuelType',2)
        // ->whereMonth('fuelDate',$monid)
        // ->whereYear('fuelDate', $yr)
        ->get();


        
        $data['fuel_info_oil'] = DB::table('fuelgas')
        ->select('vehicleId','items.item_name  as vehicle_name','fuelType', DB::raw('sum(totalUnit) as total') ,DB::raw('sum(totalCost) as totalcost'))
        ->join('items','fuelgas.vehicleId','=','items.id')
        ->groupBy('vehicleId','fuelType','items.item_name')
        ->where('fuelgas.fuelType',1)
        // ->whereMonth('fuelDate',$monid)
        // ->whereYear('fuelDate', $yr)
        ->get();

        $data['fuel_info_all'] = DB::table('fuelgas')
        ->select('vehicleId','items.item_name  as vehicle_name', DB::raw('sum(totalUnit) as total'),DB::raw('sum(totalCost) as totalcosts'))
        ->join('items','fuelgas.vehicleId','=','items.id')
        ->groupBy('vehicleId','items.item_name')
        ->get();


        // dd($data['fuel_info_all']);

        // exit;


        
        //dd($fuel_info);

        $data['vehicles'] =Item::all();

        $data['totaldistance'] =  DB::table('vehicleroutemaps')
        ->select('vehicle_id','items.item_name  as vehicle_name',DB::raw('sum(agomon - prosthan) as distance_covered'))
        ->join('items','vehicleroutemaps.vehicle_id','=','items.id')
        ->groupBy('vehicle_id','items.item_name')
        // ->whereMonth('period_from',$monid)
        // ->whereYear('period_from', $yr)
        ->get();

        // dd($totaldistance);

        return view('pages.report.consumedata',$data);

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
   
                    return redirect()->route('vehicleroutemap.entry')->with('success','Data has been Saved.');

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

            if($request->initiatetime !="" || $request->reachtime !="")
            {

                $item->period_from=$request->initiatetime;
                $item->period_to=$request->reachtime;
                $item->save();
            }
            $item->save();
   
            return redirect()->route('vehicleroutemap.entry')->with('success','Data has been updated.');

       
    }


    public function  reportfiltering (Request $request)

    {

       $vehicleid=$request->vehicleid;
        $monid=$request->monid;
        $yr=$request->yr;


if($vehicleid!="" && $yr!="" && $monid!=="")

{

    $data['fuel_info_gas'] = DB::table('fuelgas')
    ->select('vehicleId','items.item_name  as vehicle_name','fuelType', DB::raw('sum(totalUnit) as total') ,DB::raw('sum(totalCost) as totalcost'))
    ->join('items','fuelgas.vehicleId','=','items.id')
    ->groupBy('vehicleId','fuelType','items.item_name')
    ->whereMonth('fuelDate',$monid)
    ->whereYear('fuelDate', $yr)
    ->where('fuelgas.vehicleId',$vehicleid)
    ->where('fuelgas.fuelType',2)
    ->get();


    $data['fuel_info_oil'] = DB::table('fuelgas')
    ->select('vehicleId','items.item_name  as vehicle_name','fuelType', DB::raw('sum(totalUnit) as total') ,DB::raw('sum(totalCost) as totalcost'))
    ->join('items','fuelgas.vehicleId','=','items.id')
    ->groupBy('vehicleId','fuelType','items.item_name')
    ->whereMonth('fuelDate',$monid)
    ->whereYear('fuelDate', $yr)
    ->where('fuelgas.vehicleId',$vehicleid)
    ->where('fuelgas.fuelType',1)
    ->get();


    $data['fuel_info_all'] = DB::table('fuelgas')
    ->select('vehicleId','items.item_name  as vehicle_name', DB::raw('sum(totalUnit) as total'),DB::raw('sum(totalCost) as totalcosts'))
    ->join('items','fuelgas.vehicleId','=','items.id')
    ->groupBy('vehicleId','items.item_name')
    ->whereMonth('fuelDate',$monid)
    ->whereYear('fuelDate', $yr)
    ->where('fuelgas.vehicleId',$vehicleid)
    ->get();



    //dd($fuel_info);

    $data['vehicles'] =Item::all();

    $data['totaldistance'] =  DB::table('vehicleroutemaps')
    ->select('vehicle_id','items.item_name  as vehicle_name',DB::raw('sum(agomon - prosthan) as distance_covered'))
    ->join('items','vehicleroutemaps.vehicle_id','=','items.id')
    ->groupBy('vehicle_id','items.item_name')
    ->whereMonth('period_from',$monid)
    ->whereYear('period_from', $yr)
    ->where('vehicleroutemaps.vehicle_id',$vehicleid)
    ->get();

    // dd($totaldistance);

    return view('pages.report.consumedata',$data);

}
   


if($vehicleid!="" && $yr!="" && $monid=="")

{

    $data['fuel_info_gas'] = DB::table('fuelgas')
    ->select('vehicleId','items.item_name  as vehicle_name','fuelType', DB::raw('sum(totalUnit) as total') ,DB::raw('sum(totalCost) as totalcost'))
    ->join('items','fuelgas.vehicleId','=','items.id')
    ->groupBy('vehicleId','fuelType','items.item_name')
    ->whereYear('fuelDate', $yr)
    ->where('fuelgas.vehicleId',$vehicleid)
    ->where('fuelgas.fuelType',2)
    ->get();

    $data['fuel_info_oil'] = DB::table('fuelgas')
    ->select('vehicleId','items.item_name  as vehicle_name','fuelType', DB::raw('sum(totalUnit) as total') ,DB::raw('sum(totalCost) as totalcost'))
    ->join('items','fuelgas.vehicleId','=','items.id')
    ->groupBy('vehicleId','fuelType','items.item_name')
    ->whereYear('fuelDate', $yr)
    ->where('fuelgas.vehicleId',$vehicleid)
    ->where('fuelgas.fuelType',1)
    ->get();



    $data['fuel_info_all'] = DB::table('fuelgas')
    ->select('vehicleId','items.item_name  as vehicle_name', DB::raw('sum(totalUnit) as total'),DB::raw('sum(totalCost) as totalcosts'))
    ->join('items','fuelgas.vehicleId','=','items.id')
    ->groupBy('vehicleId','items.item_name')
    ->whereYear('fuelDate', $yr)
    ->where('fuelgas.vehicleId',$vehicleid)
    ->get();
    //dd($fuel_info);

    $data['vehicles'] =Item::all();

    $data['totaldistance'] =  DB::table('vehicleroutemaps')
    ->select('vehicle_id','items.item_name  as vehicle_name',DB::raw('sum(agomon - prosthan) as distance_covered'))
    ->join('items','vehicleroutemaps.vehicle_id','=','items.id')
    ->groupBy('vehicle_id','items.item_name')
    ->whereYear('period_from', $yr)
    ->where('vehicleroutemaps.vehicle_id',$vehicleid)
    ->get();

    // dd($totaldistance);

    return view('pages.report.consumedata',$data);

}
  
      
if($yr!="" && $monid=="" && $vehicleid=="")
{

        $data['fuel_info_gas'] = DB::table('fuelgas')
        ->select('vehicleId','items.item_name  as vehicle_name','fuelType', DB::raw('sum(totalUnit) as total') ,DB::raw('sum(totalCost) as totalcost'))
        ->join('items','fuelgas.vehicleId','=','items.id')
        ->groupBy('vehicleId','fuelType','items.item_name')
        ->whereYear('fuelDate', $yr)
        ->where('fuelgas.fuelType',2)
        ->get();


        $data['fuel_info_oil'] = DB::table('fuelgas')
        ->select('vehicleId','items.item_name  as vehicle_name','fuelType', DB::raw('sum(totalUnit) as total') ,DB::raw('sum(totalCost) as totalcost'))
        ->join('items','fuelgas.vehicleId','=','items.id')
        ->groupBy('vehicleId','fuelType','items.item_name')
        ->whereYear('fuelDate', $yr)
        ->where('fuelgas.fuelType',1)
        ->get();
        //dd($fuel_info);


        $data['fuel_info_all'] = DB::table('fuelgas')
        ->select('vehicleId','items.item_name  as vehicle_name', DB::raw('sum(totalUnit) as total'),DB::raw('sum(totalCost) as totalcosts'))
        ->join('items','fuelgas.vehicleId','=','items.id')
        ->groupBy('vehicleId','items.item_name')
        ->whereYear('fuelDate', $yr)
        ->get();

        $data['vehicles'] =Item::all();

        $data['totaldistance'] =  DB::table('vehicleroutemaps')
        ->select('vehicle_id','items.item_name  as vehicle_name',DB::raw('sum(agomon - prosthan) as distance_covered'))
        ->join('items','vehicleroutemaps.vehicle_id','=','items.id')
        ->groupBy('vehicle_id','items.item_name')

        ->whereYear('period_from', $yr)
        ->get();

        // dd($totaldistance);

        return view('pages.report.consumedata',$data);

}

if($yr!="" && $monid!==""  && $vehicleid=="")

{
    
    $data['fuel_info_oil'] = DB::table('fuelgas')
    ->select('vehicleId','items.item_name  as vehicle_name','fuelType', DB::raw('sum(totalUnit) as total') ,DB::raw('sum(totalCost) as totalcost'))
    ->join('items','fuelgas.vehicleId','=','items.id')
    ->groupBy('vehicleId','fuelType','items.item_name')
    ->whereMonth('fuelDate',$monid)
    ->whereYear('fuelDate', $yr)
    ->where('fuelgas.fuelType',1)
    ->get();

    $data['fuel_info_gas'] = DB::table('fuelgas')
    ->select('vehicleId','items.item_name  as vehicle_name','fuelType', DB::raw('sum(totalUnit) as total') ,DB::raw('sum(totalCost) as totalcost'))
    ->join('items','fuelgas.vehicleId','=','items.id')
    ->groupBy('vehicleId','fuelType','items.item_name')
    ->whereMonth('fuelDate',$monid)
    ->whereYear('fuelDate', $yr)
    ->where('fuelgas.fuelType',2)
    ->get();


    $data['fuel_info_all'] = DB::table('fuelgas')
    ->select('vehicleId','items.item_name  as vehicle_name', DB::raw('sum(totalUnit) as total'),DB::raw('sum(totalCost) as totalcosts'))
    ->join('items','fuelgas.vehicleId','=','items.id')
    ->groupBy('vehicleId','items.item_name')
    ->whereMonth('fuelDate',$monid)
    ->whereYear('fuelDate', $yr)
    ->get();

    //dd($fuel_info);

    $data['vehicles'] =Item::all();

    $data['totaldistance'] =  DB::table('vehicleroutemaps')
    ->select('vehicle_id','items.item_name  as vehicle_name',DB::raw('sum(agomon - prosthan) as distance_covered'))
    ->join('items','vehicleroutemaps.vehicle_id','=','items.id')
    ->groupBy('vehicle_id','items.item_name')
    ->whereMonth('period_from',$monid)
    ->whereYear('period_from', $yr)
    ->get();

    // dd($totaldistance);

    return view('pages.report.consumedata',$data);

}
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

   
        // DB::table('vehicleroutemaps')
        // ->select('vehicleroutemaps.prosthan')
        // ->where('vehicleroutemaps.vehicle_id',$vehicleid)
        // ->sum('prosthan');
       


        return view('pages.vehicleroutemap.filter',$data);

       }

    }


}
