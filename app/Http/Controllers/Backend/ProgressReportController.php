<?php


namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\progress_report;


class ProgressReportController extends Controller
{

    // public function inser(){

    // $progress_reports = progress_report::all();
    // return view('insert')->with('progress_report',$progress_reports);

    // }

    public function welcome()
    {
        return view('welcome');
    }
    public function insert()
    {
        return view('insert');
    }


    public function store(Request $request)
    {
        //dd('Submitted');


        $this->validate(
            $request,
            [

                'Courses_offered' => 'required|string',
                'Level_skills' => 'required|string',
                'Training_target' => 'required|string',
                'male' => 'required|string',
                'female' => 'required|string',
                'total' => 'required|string',
                'Training_target_2nd' => 'required|string',
                'male2' => 'required|string',
                'female2' => 'required|string',
                'total2' => 'required|string',
                'cummulative_achived' => 'required|string'

            ]
        );

        $progress_reports = new progress_report;
        $progress_reports->Courses_offered = $request->Courses_offered;
        $progress_reports->Level_skills = $request->Level_skills;
        $progress_reports->Training_target = $request->Training_target;
        $progress_reports->male = $request->male;
        $progress_reports->female = $request->female;
        $progress_reports->total = $request->total;
        $progress_reports->Training_target_2nd = $request->Training_target_2nd;
        $progress_reports->male2 = $request->male2;
        $progress_reports->female2 = $request->female2;
        $progress_reports->total2 = $request->total2;
        $progress_reports->cummulative_achived = $request->cummulative_achived;

        $progress_reports->save();
        return redirect()->route("welcome")->with('message', 'Data Saved Successfully');

        // return back();

    }
}
