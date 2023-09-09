<?php


namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\number_trainers;
use Illuminate\Http\Request;

class NumberTrainersController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }
    public function insert()
    {
        return view('insert');
    }


    public function storeF(Request $request)
    {
        //dd('Submitted');


        $this->validate(
            $request,
            [

                'skills_areas' => 'required|string',
                'training_title' => 'required|string',
                'duration' => 'required|string',
                'participants' => 'required|string',
                'male' => 'required|string',
                'female' => 'required|string',
                'total' => 'required|string',


            ]
        );

        $number_trainers = new number_trainers;
        $number_trainers->skills_areas = $request->skills_areas;
        $number_trainers->training_title = $request->training_title;
        $number_trainers->duration = $request->duration;
        $number_trainers->participants = $request->participants;
        $number_trainers->male = $request->male;
        $number_trainers->female = $request->female;
        $number_trainers->total = $request->total;



        $number_trainers->save();
        return redirect()->route("welcome")->with('message', 'Data Saved Successfully');

        // return back();

    }
}
