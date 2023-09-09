<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;
use App\Models\Models\Batch;
use App\Models\Module;
use App\Models\ModuleWiseCourse;
use App\Models\Subject;
use App\Models\participant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Auth;
use Carbon\Carbon;
use Carbon\CarbonInterval;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //  $noticeList = Notice::get();

        $data['requestlist']=DB::table('notices')
        ->select('notices.id','notices.title as subject','notices.details','notices.remarks','notices.notice_status','participants.name as send_from','users.name as send_person','intakes.name as department','notices.send_to','notices.created_at','notices.file_name' )
        ->join('participants', 'notices.send_from', '=', 'participants.id')
        ->join('users', 'notices.send_to', '=', 'users.id')
        ->join('intakes', 'participants.intake_id', '=', 'intakes.id')
        ->where('notices.send_from','=', auth()->user()->id)
        ->orWhere('notices.send_to','=', auth()->user()->id)
        ->orderBy('notices.created_at', 'DESC')
        ->paginate(15);
      
       // $startTime = $data['requestlist']->created_at;
        // print_r( $data['requestlist']->created_at);
        // exit;
        // return $timeleft;
        // $ldate = date('Y-m-d H:i:s');

       

        $data['requestlistall']=DB::table('notices')
        ->select('notices.id','notices.title as subject','notices.details','notices.remarks','notices.notice_status','participants.name as send_from','users.name as send_person','intakes.name as department','notices.send_to','notices.created_at','notices.file_name')
        ->join('participants', 'notices.send_from', '=', 'participants.id')
        ->join('users', 'notices.send_to', '=', 'users.id')
        ->join('intakes', 'participants.intake_id', '=', 'intakes.id')
        ->orderBy('notices.created_at', 'DESC')
        ->paginate(15);

     
        $data['subjectList']=DB::table('participants')
        ->select('participants.id','participants.name','intakes.name as deptname' ,'subjects.name as designame') 
        ->join('subjects', 'participants.desig_id', '=', 'subjects.id') 
        ->join('intakes', 'participants.intake_id', '=', 'intakes.id') 
        ->where('participants.role','!=','4')
        ->where('participants.role','!=','3')
        ->get();
       
        // foreach($data['requestlistall'] as $request)
        // {

        // $formatted_dt1=Carbon::parse($request->created_at);
        // $formatted_dt2=Carbon::parse(now());
        
        // $totalDuration = $formatted_dt1->DiffInSeconds($formatted_dt2);
        
        // $totalDuration= CarbonInterval::seconds($totalDuration)->cascade()->forHumans();
        // echo $totalDuration;
        // exit;
        
        // }
       
        return view('pages.notice.index',$data);
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
       
        $notice = new Notice();
        $notice->title = $request->title;
        $notice->details = $request->details;
        $notice->send_to = $request->posted_by;
        $notice->send_from=auth()->user()->id;
        $notice->save(); 

        $request->validate(['file' => 'required|mimes:pdf|max:20480' ]);
        if($request->file()) {
            
             $notice->title = $request->title;
             $notice->details = $request->details;
             $notice->send_to = $request->posted_by;
             $notice->send_from=auth()->user()->id;
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->move(public_path('images'), $fileName);
            $notice->file_name = time().'_'.$request->file->getClientOriginalName();    
            $notice->file_path = $filePath;
            $notice->save(); 
                   

         }
         return back()->with('success','request has been send.'); 
      

         
        
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
        
        $notice = Notice::find($id);
        $notice->remarks = $request->remarks;
        $notice->notice_status = $request->request_action;
        $notice->save();
        return back()->with('success','request has been updated.');
       
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        $notice = Notice::find($id);
        if (!is_null($notice)) {
            $notice->delete();
        }
        return back();
    }

    public function filter( $id)
    {

      
        if($id=='1')

        {
            $data['requestlistall']=DB::table('notices')
            ->select('notices.id','notices.title as subject','notices.details','notices.remarks','notices.notice_status','participants.name as send_from','users.name as send_person','intakes.name as department','notices.send_to','notices.created_at','notices.file_name')
            ->join('participants', 'notices.send_from', '=', 'participants.id')
            ->join('users', 'notices.send_to', '=', 'users.id')
            ->join('intakes', 'participants.intake_id', '=', 'intakes.id')
            ->where('notices.notice_status','=', '1')
            ->orderBy('notices.created_at', 'DESC')
            ->paginate(15);


        }
        if($id=='2')

        {
            $data['requestlistall']=DB::table('notices')
            ->select('notices.id','notices.title as subject','notices.details','notices.remarks','notices.notice_status','participants.name as send_from','users.name as send_person','intakes.name as department','notices.send_to','notices.created_at','notices.file_name')
            ->join('participants', 'notices.send_from', '=', 'participants.id')
            ->join('users', 'notices.send_to', '=', 'users.id')
            ->join('intakes', 'participants.intake_id', '=', 'intakes.id')
            ->where('notices.notice_status','=', '0')
            ->orderBy('notices.created_at', 'DESC')
            ->paginate(15);

        }
        if($id=='3')

        {
            $data['requestlistall']=DB::table('notices')
            ->select('notices.id','notices.title as subject','notices.details','notices.remarks','notices.notice_status','participants.name as send_from','users.name as send_person','intakes.name as department','notices.send_to','notices.created_at','notices.file_name')
            ->join('participants', 'notices.send_from', '=', 'participants.id')
            ->join('users', 'notices.send_to', '=', 'users.id')
            ->join('intakes', 'participants.intake_id', '=', 'intakes.id')
            ->whereNull('notices.notice_status')
            ->orderBy('notices.created_at', 'DESC')
            ->paginate(15);

        }

        if($id=='4')

        {
            $data['requestlistall']=DB::table('notices')
            ->select('notices.id','notices.title as subject','notices.details','notices.remarks','notices.notice_status','participants.name as send_from','users.name as send_person','intakes.name as department','notices.send_to','notices.created_at','notices.file_name')
            ->join('participants', 'notices.send_from', '=', 'participants.id')
            ->join('users', 'notices.send_to', '=', 'users.id')
            ->join('intakes', 'participants.intake_id', '=', 'intakes.id')
            ->where('notices.notice_status','=','2')
            ->orderBy('notices.created_at', 'DESC')
            ->paginate(15);

        }

        $data['subjectList']=DB::table('participants')
        ->select('participants.id','participants.name','intakes.name as deptname' ,'subjects.name as designame') 
        ->join('subjects', 'participants.desig_id', '=', 'subjects.id') 
        ->join('intakes', 'participants.intake_id', '=', 'intakes.id') 
        ->where('participants.role','!=','4')
        ->get();

        return view('pages.notice.index',$data);
    }

   
}
