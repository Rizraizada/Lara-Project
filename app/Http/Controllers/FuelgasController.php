<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Fuelgas;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FuelgasController extends Controller
{
    //

    public function index()

    {

        $data['allfuels'] = DB::table('fuelgas')
        ->select('fuelgas.id','fuelgas.supplierName','fuelgas.fuelType','fuelgas.memoNo','fuelgas.unitRate',
        'fuelgas.totalUnit','fuelgas.totalCost','fuelgas.fuelDate','fuelgas.verifiedBy', 'driver_info.driver_name',
        'items.item_name  as vehicle_name','fuelgas.vehicleId','fuelgas.driverId','users.name as createby')
        ->join('items', 'fuelgas.vehicleId', '=', 'items.id')
        ->join('driver_info', 'fuelgas.driverId', '=', 'driver_info.id')
        ->join('users', 'fuelgas.created_by', '=', 'users.id')
        ->paginate(30);


        $data['vehicles'] = Item::all();
        //dd($data['vehicles']);
        $data['drivers'] = DB::table('driver_info')->get();

        $data['fuels'] = DB::table('fuelsetup')->get();
        //dd($data['drivers']);
        return view('pages.fuelgas.index', $data);
    }



    public function store(Request $request)

    {


        $item = new Fuelgas();
        $item->vehicleId = $request->vehicleId;
        $item->driverId = $request->driverId;
        $item->supplierName = $request->supplierName;
        $item->fuelType = $request->fuelType;
        $item->memoNo = $request->memoNo;
        $item->unitRate = $request->unitRate;
        $item->totalUnit = $request->totalUnit;
        $item->totalCost = $request->totalCost;
        $item->fuelDate = $request->fuelDate;
        $item->verifiedBy = $request->verifiedBy;
        $item->created_by = Auth::user()->id;

        $item->save();

        return back()->with('success', 'Vehicle Fuel has been saved.');
    }


    public function update(Request $request, $id)
    {

        $item = Fuelgas::find($id);
        $item->vehicleId = $request->vehicleId;
        $item->driverId = $request->driverid;
        $item->supplierName = $request->supplierName;
        $item->fuelType = $request->fuelType;
        $item->memoNo = $request->memoNo;
        $item->unitRate = $request->unitRate;
        $item->totalUnit = $request->totalUnit;
        $item->totalCost = $request->totalCost;
        $item->fuelDate = $request->FuelDate;
        $item->verifiedBy = $request->verifiedBy;

if($request->fuelDate!="")

{
    $item->fuelDate = $request->fuelDate;
    $item->save();
}
        $item->save();

        return back()->with('success', 'Vehicle Fuel has been updated.');
    }

    //
}
