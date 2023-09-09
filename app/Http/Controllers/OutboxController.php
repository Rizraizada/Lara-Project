<?php

namespace App\Http\Controllers;
use App\Models\Models\Batch;
use App\Models\Module;
use App\Models\ModuleWiseCourse;
use App\Models\Subject;
use App\Models\participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class OutboxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //

    public function index()
    {
        
        $data['moduleList']=DB::table('modules')
        ->select('modules.id','modules.name','modules.note_no','modules.forwarded','modules.month','modules.file_name','modules.batch_id','batches.name as filename','module_wise_courses.remarks','modules.status','intakes.name as department','batches.year as fileno','participants.name as created_by','modules.description','modules.updated_at','modules.subnote')
        ->join('module_wise_courses', 'modules.id', '=', 'module_wise_courses.module_id')
        ->join('batches', 'modules.batch_id', '=', 'batches.id')
        ->join('intakes', 'batches.intake_id', '=', 'intakes.id')
        ->join('participants', 'modules.created_by', '=', 'participants.id')
        ->where('module_wise_courses.flag','=', 1)
        ->where('module_wise_courses.subject_id','=', auth()->user()->id)
        ->orderBy('module_wise_courses.updated_at', 'DESC')
        ->paginate(15);


        $data['intakes']=DB::table('intakes')
        ->select('intakes.id as deptid','intakes.name as deptname' )              
        ->get();


 //print_r($data['moduleList']);
 //exit;
 return view('pages.outbox.index', $data);
  
    }


    public function filtering(Request $request)
    {
        $deptid=$request->intake_id;
        $data['FilterType']=$request->input('action');

        if($data['FilterType']=='findnote')

        {
            $data['moduleList']=DB::table('modules')
            ->select('modules.id','modules.name','modules.note_no','modules.forwarded','modules.month','modules.file_name','modules.batch_id','batches.name as filename','module_wise_courses.remarks','modules.status','intakes.name as department','batches.year as fileno','participants.name as created_by','modules.description','modules.updated_at','modules.subnote')
            ->join('module_wise_courses', 'modules.id', '=', 'module_wise_courses.module_id')
            ->join('batches', 'modules.batch_id', '=', 'batches.id')
            ->join('intakes', 'batches.intake_id', '=', 'intakes.id')
            ->join('participants', 'modules.created_by', '=', 'participants.id')
            ->where('batches.intake_id','=', $deptid)
            ->where('module_wise_courses.flag','=', 1)
            ->where('module_wise_courses.subject_id','=', auth()->user()->id)
            ->orderBy('module_wise_courses.updated_at', 'DESC')
            ->get();
    
    
            $data['intakes']=DB::table('intakes')
            ->select('intakes.id as deptid','intakes.name as deptname' )              
            ->get();
    
    
     //print_r($data['moduleList']);
     //exit;
     return view('pages.outbox.outboxfilter', $data);  

        }

    }

    public function ViewNote($id)
    {   
        $data['module']=DB::table('modules')
        ->select('modules.id','modules.name','modules.month','modules.batch_id','batches.name as filename','modules.file_name','modules.description')
        ->join('batches', 'modules.batch_id', '=', 'batches.id')
        ->where('modules.id','=', $id)
        ->first();
      //print_r($data['module']);
      //exit;

      $data['remarklsit']=DB::table('module_wise_courses')
        ->select('module_wise_courses.subject_id','participants.name','module_wise_courses.remarks','module_wise_courses.flag','module_wise_courses.file_name as remark_file_name','module_wise_courses.file_path as remark_file_path')
        ->join('participants', 'module_wise_courses.subject_id', '=', 'participants.id')
        ->where('module_wise_courses.module_id','=', $id)
        ->get();
        // print_r($data1['remarklsit']);
        // exit;

        $data['notewisequery']=DB::table('queries')
       ->select('queries.id','queries.note_id','queries.query_question','queries.query_answer','participants.name as send_from','users.name as send_to','queries.query_status')
       ->join('participants', 'queries.send_from', '=', 'participants.id')
      ->join('users', 'queries.send_to', '=', 'users.id')
       ->where('note_id','=', $id)
       ->paginate(20);

// print_r($data['notewisequery']);
// exit;

        $data['countquery']= $data['query']=DB::table('queries')
        ->select('id','note_id','query_question','query_answer','send_from','send_to')
        ->where('note_id','=', $id)
        ->count();
        return view('pages.outbox.edit', $data);



    }

    public function close()
    {   
        return redirect()->to('/dashboard');
        //return Redirect()->route('outbox.index');

    }
}


