<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Intake;
use App\Models\Mark;
use App\Models\Models\Batch;
use App\Models\Module;
use App\Models\Participant;
use App\Models\Subject;
use Illuminate\Http\Request;

class MarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $batches = Batch::get();
        $intakes = Intake::get();
        $marks = Mark::get();
        $participants = Participant::get();
        $subjects = Subject::get();
        $modules = Module::get();
        return view('pages.mark.index', compact('marks', 'intakes', 'batches', 'participants', 'subjects', 'modules'));
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
        $mark = new Mark();
        $mark->batch_id = $request->batch_id;
        $mark->module_id = $request->module_id;
        $mark->participant_id = $request->participant_id;
        $mark->subject_id = $request->subject_id;
        $mark->intake_id = $request->intake_id;
        $mark->marks = $request->marks;
        $mark->save();
        return back();
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
        $mark = Mark::find($id);
        $mark->batch_id = $request->batch_id;
        $mark->module_id = $request->module_id;
        $mark->participant_id = $request->participant_id;
        $mark->subject_id = $request->subject_id;
        $mark->intake_id = $request->intake_id;
        $mark->marks = $request->marks;
        $mark->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mark = Mark::find($id);
        if (!is_null($mark)) {
            $mark->delete();
        }
        return back();
    }
}
