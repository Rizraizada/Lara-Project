<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Intake;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class IntakeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $intakes = Intake::get();
        return view('pages.intake.index', compact('intakes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $intake = new Intake();
        $intake->name = $request->intake_name;
        $intake->dept_prefix = $request->dept_prefix;
        $intake->sl_no = $request->sl_no;
        $intake->save();
        return back()->with('success','Data has been saved.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $intake = Intake::find($id);
        $intake->name = $request->intake_name;
        $intake->dept_prefix = $request->dept_prefix;
        $intake->sl_no = $request->sl_no;
        $intake->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $intake = Intake::find($id);
        if (!is_null($intake)) {
            $intake->delete();
        }
        return back();
    }
}
