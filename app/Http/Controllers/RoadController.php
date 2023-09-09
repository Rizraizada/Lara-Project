<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Road;
use Illuminate\Http\Request;

class RoadController extends Controller
{
    //

    public function index()

    {

        $data['roads'] =Road::all();


    return view('pages.road.index',$data);
    
    }


    public function store(Request $request)

    {

          $item=new Road();
            
          $item->Road_name=$request->road_name;
          $item->save();

            return back()->with('success','Route  has been saved.');

    }

    public function update(Request $request, $id)
    {

        $item = Road::find($id);
        $item->Road_name=$request->road_name;
        $item->save();

            return back()->with('success','Data has been updated.');
       
    }

}
