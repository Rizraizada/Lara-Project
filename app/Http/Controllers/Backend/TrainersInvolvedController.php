<?php


namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\trainers_involved;

class TrainersInvolvedController extends Controller
{

    public function welcome()
    {
        return view('welcome');
    }
    public function insert()
    {
        return view('insert');
    }


    public function storeE(Request $request)
    {
        //dd('Submitted');


        $this->validate(
            $request,
            [

                'Courses_offered' => 'required|string',
                'training_type' => 'required|string',
                'duration' => 'required|string',
                'training_target' => 'required|string',
                'male' => 'required|string',
                'female' => 'required|string',
                'total' => 'required|string',


            ]
        );

        $trainers_involveds = new trainers_involved;
        $trainers_involveds->Courses_offered = $request->Courses_offered;
        $trainers_involveds->training_type = $request->training_type;
        $trainers_involveds->duration = $request->duration;
        $trainers_involveds->training_target = $request->training_target;
        $trainers_involveds->male = $request->male;
        $trainers_involveds->female = $request->female;
        $trainers_involveds->total = $request->total;



        $trainers_involveds->save();
        return redirect()->route("welcome")->with('message', 'Data Saved Successfully');

        // return back();

    }
}
