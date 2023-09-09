<?php


namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\progressb;

class ProgressbController extends Controller
{


    public function welcome()
    {
        return view('welcome');
    }
    public function insert()
    {
        return view('insert');
    }


    public function storeB(Request $request)
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

        $progressbs = new progressb;
        $progressbs->Courses_offered = $request->Courses_offered;
        $progressbs->Level_skills = $request->Level_skills;
        $progressbs->Training_target = $request->Training_target;
        $progressbs->male = $request->male;
        $progressbs->female = $request->female;
        $progressbs->total = $request->total;
        $progressbs->Training_target_2nd = $request->Training_target_2nd;
        $progressbs->male2 = $request->male2;
        $progressbs->female2 = $request->female2;
        $progressbs->total2 = $request->total2;
        $progressbs->cummulative_achived = $request->cummulative_achived;

        $progressbs->save();
        return redirect()->route("welcome")->with('message', 'Data Saved Successfully');

        // return back();

    }
}
