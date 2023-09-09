<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class fuelController extends Controller
{
    //

    public function index()

    {

        $data['items']=DB::table('vehicledrivers')
        ->select('vehicledrivers.id','driver_info.driver_name','items.item_name  as vehicle_name',
        'vehicledrivers.duration_from','vehicledrivers.duration_to' ,'vehicledrivers.vehicle_id','vehicledrivers.vehicle_driver_id')
        ->join('items','vehicledrivers.vehicle_id','=','items.id')
        ->join('driver_info', 'vehicledrivers.vehicle_driver_id', '=', 'driver_info.id')
        ->paginate(20);

        $data['vehicles'] =Item::all();

        $data['drivers'] =DB::table('driver_info')->get();


    return view('pages.fuelregister.index',$data);
    
    }
}
