<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Floor;
use App\Models\Floorexpense;
use App\Models\FloorSettle;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FloorexpenseController extends Controller
{
    public function index()

    {

        $data['floors_expense'] =DB::table('floorexpenses')
        ->select('floorexpenses.id','floorexpenses.expense_quantity','floorexpenses.expense_price','units.unit_name as uom','floors.floor_name','items.item_name','items.price','floorexpenses.created_at')
        ->join('floors','floors.id','=','floorexpenses.floor_id')
        ->join('items','items.id','=','floorexpenses.item_id')
        ->join('units','units.id','=','items.uom')
        ->orderBy('floor_name','asc')
        ->paginate(20);
        
        $data['floors']=Floor ::get();

        $data['items']=Item::get();



    return view('pages.floorexpense.index',$data);
    
    }


    public function get_item_dtl_data(Request $request)
    {
        // $PresMedicine = PresMedicine::latest()->paginate(5);
        $TemplateDtls =  DB::table('items')
        ->select('items.id','items.item_name','items.price','units.unit_name','floor_settles.quantity as init_quantity',
        'floor_settles.remain_qunatity as quantity')
        ->join('units','units.id','=','items.uom')
        ->join('floor_settles','floor_settles.item_id','=','items.id')
        ->where('items.id', $request->id)
        ->where('floor_settles.floor_id', '=',1)
        ->get();
       
        

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

                'expense_quantity'=>'required|integer',
                'item_id'=>'required'
            ]
        );

        $floor=new Floorexpense();
        $floor->floor_id=$request->floor_id;
        $floor->item_id=$request->item_id;
        $floor->expense_quantity=$request->expense_quantity;
        $floor->expense_price=$request->expense_price;

        $floor->save();

        $flooritem=FloorSettle::where('floor_id',$request->floor_id)
        ->where('item_id',$request->item_id)
        ->first();


        // dd($flooritem);
        // exit;

            if($flooritem && $request->expense_quantity !=null) 
            {
                $stock=$flooritem->remain_qunatity-$request->expense_quantity;

                    $flooritem->update([
                        'remain_qunatity' => $stock
                    ]);
            }



        
        return back()->with('success','Floor Item Expense has been saved.');

    }


    public function update(Request $request, $id)
    {

       
    }


    public function filtering(Request $request)
    {
       
        $floorid=$request->floor_id;
       
      
        $data['floors_expense'] = DB::table('floorexpenses')
        ->select('floorexpenses.id','floorexpenses.expense_quantity','floorexpenses.expense_price','units.unit_name as uom',
        'floors.floor_name','items.item_name','items.price','floorexpenses.created_at')
        ->join('floors','floors.id','=','floorexpenses.floor_id')
        ->join('items','items.id','=','floorexpenses.item_id')
        ->join('units','units.id','=','items.uom')
        ->where('floors.id',$floorid)
        ->orderBy('floor_name','asc')
        ->get();  
                

        $data['floors']=Floor::get();
        $data['items']=Item::get();

        $totalprice = DB::table('floorexpenses')->where('floor_id',$floorid)->sum('expense_price');

      
                return view('pages.floorexpense.filter',$data,['totalprice'=>$totalprice]);

        }
     


        public function stockreport()
        {
            $data['floors']=Floor::get();
            $data['items']=Item::get();
            
            return view('pages.stocks.index',$data);

        }

        public function stock(Request $request)
        {
           
            $floorid=$request->floor_id;
           
            $data['stock'] = DB::table('floor_settles')
            ->select('floor_settles.id','floor_settles.quantity','floor_settles.remain_qunatity',

            DB::raw('coalesce(floor_settles.quantity,0) -  coalesce(floor_settles.remain_qunatity,0) as stock_quantity')
            ,'units.unit_name as uom',
            'floors.floor_name','items.item_name','items.price')
            ->join('floors','floors.id','=','floor_settles.floor_id')
            ->join('items','items.id','=','floor_settles.item_id')
            ->join('units','units.id','=','items.uom')
            ->where('floors.id',$floorid)
            ->get();
            
            $data['floors']=Floor::get();
            $data['items']=Item::get();

            return view('pages.stocks.filter',$data);

        }

}
