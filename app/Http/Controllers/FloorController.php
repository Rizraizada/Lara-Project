<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Floor;
use App\Models\FloorSettle;
use App\Models\Item;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FloorController extends Controller
{
   
    public function index()

    {

        $data['floors_settle'] = DB::table('floor_settles')
        ->select('floor_settles.id','floor_settles.quantity','floor_settles.remain_qunatity','floor_settles.total_price','units.unit_name as uom',
        'floors.floor_name','items.item_name','items.price')
        ->join('floors','floors.id','=','floor_settles.floor_id')
        ->join('items','items.id','=','floor_settles.item_id')
        ->join('units','units.id','=','items.uom')
        ->orderBy('floor_name','asc')
        ->paginate(20);
        
        $data['floors']=Floor::get();

        $data['items']=Item::get();



    return view('pages.floors.index',$data);
    
    }


    public function get_item_dtl_data(Request $request)
    {
        // $PresMedicine = PresMedicine::latest()->paginate(5);
        $TemplateDtls =  DB::table('items')
        ->select('items.id','items.item_name','items.price','units.unit_name')
        ->join('units','units.id','=','items.uom')
        ->where('items.id', $request->id)->get();
       
        

        if (!is_null($TemplateDtls)) {
            return response()->json(["status" => "success", "message" => "Success! Item Data Found.", "data" => $TemplateDtls]);
        } else {
            return response()->json(["status" => "failed", "message" => "Alert! Item Data not Found"]);
        }
    }



    public function store(Request $request)

    {
            $request->validate(
                [

                    'quantity'=>'required|integer',
                    'item_id'=>'required'
                ]
            );

            $floor=new FloorSettle();
            $floor->floor_id=$request->floor_id;
            $floor->item_id=$request->item_id;
            $floor->quantity=$request->quantity;
            $floor->total_price=$request->tot_price;

            $floor->save();

            return back()->with('success','Floor Item has been saved.');

    }


    public function update(Request $request, $id)
    {

        $floor = FloorSettle::find($id);
        $floor->quantity=$request->quantity;
        $floor->total_price=$request->tot_price;
        $floor->save();


            return redirect()->route('flooritem.entry')->with('success','Data has been updated.');
       
            //return back()->with('success','Data has been updated.');
    }


    public function filtering(Request $request)
    {
       $vehicleid=$request->vehicleid;
       
      
        $data['floors_settle'] = DB::table('floor_settles')
        ->select('floor_settles.id','floor_settles.quantity','floor_settles.total_price','units.unit_name as uom',
        'floors.floor_name','items.item_name','items.price')
        ->join('floors','floors.id','=','floor_settles.floor_id')
        ->join('items','items.id','=','floor_settles.item_id')
        ->join('units','units.id','=','items.uom')
        ->where('floors.id',$floorid)
        ->orderBy('floor_name','asc')
        ->get();  
                

        $data['floors']=Floor::get();
        $data['items']=Item::get();

        $totalprice = DB::table('floor_settles')->where('floor_id',$floorid)->sum('total_price');

      
                return view('pages.floors.filter',$data,['totalprice'=>$totalprice]);

        }




}


   

