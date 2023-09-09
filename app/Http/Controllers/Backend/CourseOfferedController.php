<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\course_offered;

class CourseOfferedController extends Controller
{

    public function welcome()
    {
        return view('welcome');
    }
    public function insert()
    {
        return view('insert');
    }


    public function storeD(Request $request)
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

        $course_offereds = new course_offered;
        $course_offereds->Courses_offered = $request->Courses_offered;
        $course_offereds->training_type = $request->training_type;
        $course_offereds->duration = $request->duration;
        $course_offereds->training_target = $request->training_target;
        $course_offereds->male = $request->male;
        $course_offereds->female = $request->female;
        $course_offereds->total = $request->total;



        $course_offereds->save();
        return redirect()->route("welcome")->with('message', 'Data Saved Successfully');

        // return back();

    }
}
