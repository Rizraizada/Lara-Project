<?php


namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\placed_jobs;

class PlacedJobsController extends Controller
{

    public function welcome()
    {
        return view('welcome');
    }
    public function insert()
    {
        return view('insert');
    }


    public function storeC(Request $request)
    {
        //dd('Submitted');


        $this->validate(
            $request,
            [

                'Courses_offered' => 'required|string',
                'Level_skills' => 'required|string',
                'job_placement' => 'required|string',
                'male' => 'required|string',
                'female' => 'required|string',
                'total' => 'required|string',
                'job_placement_2nd' => 'required|string',
                'male2' => 'required|string',
                'female2' => 'required|string',
                'total2' => 'required|string',
                'cummulative_achived' => 'required|string'

            ]
        );

        $placed_jobs = new placed_jobs;
        $placed_jobs->Courses_offered = $request->Courses_offered;
        $placed_jobs->Level_skills = $request->Level_skills;
        $placed_jobs->job_placement = $request->job_placement;
        $placed_jobs->male = $request->male;
        $placed_jobs->female = $request->female;
        $placed_jobs->total = $request->total;
        $placed_jobs->job_placement_2nd = $request->job_placement_2nd;
        $placed_jobs->male2 = $request->male2;
        $placed_jobs->female2 = $request->female2;
        $placed_jobs->total2 = $request->total2;
        $placed_jobs->cummulative_achived = $request->cummulative_achived;

        $placed_jobs->save();
        return redirect()->route("welcome")->with('message', 'Data Saved Successfully');

        // return back();

    }
}
