<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class ItemController extends Controller
{
    //get all item

        public function index()

        {

            $data['items'] =Item::all();


        return view('pages.items.index',$data);
        
        }


        public function store(Request $request)

        {
                $request->validate(
                    [

                        'vehicle_name'=>'required|string',
                      
                    ]
                );

                $item=new Item();
                $item->item_name=$request->vehicle_name;
                $item->licence_no=$request->licence_no;
                $item->model_no=$request->model_no;
                $item->yr_of_manufact=$request->manufac_year;
                $item->date_of_purchase=$request->dt_of_purc;
                $item->tax_no=$request->tax_no;
                $item->dt_of_tax=$request->dt_of_tax;
                $item->dt_of_lic=$request->dt_of_lic;
                $item->dt_of_fit=$request->dt_of_fit;
             

                if($request->file('file')==''){
                    $item->save();
        
                }
               
                if($request->file('file')!='')
               {

                $request->validate(['file' => 'required|mimes:jpg,png|max:1024' ]);
                if($request->file()) {
               
                  
                    $fileName = time().'_'.$request->file->getClientOriginalName();
                    // $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
                    $filePath = $request->file('file')->move(public_path('images'), $fileName);
                    $item->image_name = time().'_'.$request->file->getClientOriginalName();
                    // $module->file_path = '/storage/' . $filePath;
                    $item->image_path = $filePath;
                    $item->save();
                          
                }
               }
                

                return back()->with('success','Vehicle  has been saved.');

        }

        public function update(Request $request, $id)
        {

            $item = Item::find($id);
             $item->item_name=$request->vehicle_name;
            $item->licence_no=$request->licence_no;
            $item->model_no=$request->model_no;
            $item->tax_no=$request->tax_no;

            if($request->dt_of_tax!='' || $request->dt_of_lic!='' || $request->dt_of_fit!='')
            {
                $item->dt_of_tax=$request->dt_of_tax;
                $item->dt_of_lic=$request->dt_of_lic;
                $item->dt_of_fit=$request->dt_of_fit;
            }
          
               if($request->file('file')==''){
                $item->save();
    
            }



            if($request->file('file')!='')
            {

             $request->validate(['file' => 'required|mimes:jpg,png|max:1024' ]);
             if($request->file()) {
            
               
                 $fileName = time().'_'.$request->file->getClientOriginalName();
                 // $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
                 $filePath = $request->file('file')->move(public_path('images'), $fileName);
                 $item->image_name = time().'_'.$request->file->getClientOriginalName();
                 // $module->file_path = '/storage/' . $filePath;
                 $item->image_path = $filePath;
                 $item->save();
                       
             }
            }

                return back()->with('success','Data has been updated.');
           
        }


        public function viewdetails()
        {
            
            $data['items'] =Item::all();

            return view('pages.items.details',$data);
            # code...


        }



public function getvehicles()

{



    $vehicles=DB::table('vehicle_route_times')
    ->select('vehicle_route_times.vehicle_id','items.item_name as vehicle_name','vehicle_route_times.up_trip_start_time','vehicle_route_times.up_trip_end_time',
    'vehicle_route_times.down_trip_start_time','vehicle_route_times.down_trip_end_time','vehicle_route_times.up_trip_start'
    ,'vehicle_route_times.up_trip_end','vehicle_route_times.down_trip_start','vehicle_route_times.down_trip_end')
    ->join('items','vehicle_route_times.vehicle_id','=','items.id')
    ->get();

    // $vehicles=DB::table('vehicle_route_times')->get();
    return Response()->json($vehicles, 200);

}

        public function getitems()
        {
            # code...


            $item=DB::table('items')->get();

            return Response()->json($item, 200);
        }


        public function insertitem(Request $request )
        {


            $data=array();
            $data['itemname']=$request->itemname;
            $data['price']=$request->price;
            DB::table('items')->insert($data);
            return Response()->json(['message'=>'a new item has been created'],200);

        }

        public function destroy($id)
        {

            DB::table('items')->where('id',$id)->delete();
            return Response('item has been deleted ', 200);

        }

        public function edititem($id)
        {
            # code...


            $item=DB::table('items')->where('id',$id)->first();

            return Response()->json($item, 200);
        }

        public function updateitem(Request $request ,$id)
        {
            $data=array();
            $data['itemname']=$request->itemname;
            $data['price']=$request->price;
            $data['uom']=$request->uom;
            DB::table('items')->where('id',$id)->update($data);
            return Response()->json(['message'=>'item has been updated'],200);

        }
}
