<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\accessories;
use Illuminate\Http\Request;

class AccessoriesController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }
    public function insert()
    {
        return view('insert');
    }


    public function storeG(Request $request)
    {
        //dd('Submitted');


        $this->validate(
            $request,
            [

                'job_title' => 'required|string',
                'training_title' => 'required|string',
                'duration' => 'required|string',
                'participants' => 'required|string',
                'male' => 'required|string',
                'female' => 'required|string',
                'total' => 'required|string',


            ]
        );

        $accessories = new accessories;
        $accessories->job_title = $request->job_title;
        $accessories->training_title = $request->training_title;
        $accessories->duration = $request->duration;
        $accessories->participants = $request->participants;
        $accessories->male = $request->male;
        $accessories->female = $request->female;
        $accessories->total = $request->total;



        $accessories->save();
        return redirect()->route("welcome")->with('message', 'Data Saved Successfully');

        // return back();

    }
}
