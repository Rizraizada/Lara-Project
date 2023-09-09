<?php

namespace App\Http\Controllers;
use App\Models\Models\Batch;
use App\Models\Module;
use App\Models\ModuleWiseCourse;
use App\Models\Subject;
use App\Models\participant;
use App\Models\Queri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;

class InboxController extends Controller
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
            ->select('modules.id','modules.note_no','modules.name','modules.forwarded','modules.month','modules.file_name','modules.batch_id','batches.name as filename','module_wise_courses.remarks','intakes.name as department','batches.year','modules.status','participants.name as created_by','modules.description','modules.updated_at','modules.subnote','modules.moduleid','module_wise_courses.updated_at as inbox_time')
            ->join('module_wise_courses', 'modules.id', '=', 'module_wise_courses.module_id')
            ->join('batches', 'modules.batch_id', '=', 'batches.id')
            ->join('intakes', 'batches.intake_id', '=', 'intakes.id')
            ->join('participants', 'modules.created_by', '=', 'participants.id')
            //->whereNull('modules.status')
            //->where('modules.status','!=','Board')
            ->where('modules.note_status','=', 1)
            ->where('module_wise_courses.flag','=', 0)
            ->where('module_wise_courses.subject_id','=', auth()->user()->id)
            ->orderBy('updated_at', 'DESC')
            ->distinct()
            ->paginate(15);

            // print_r($data['moduleList']);
            // exit;
    

          

    return view('pages.inbox.index', $data);
  
    }

    public function boardinbox()
    {
        $data['moduleList']=DB::table('modules')
        ->select('modules.id','modules.note_no','modules.name','modules.forwarded','modules.month','modules.file_name','modules.batch_id','batches.name as filename','intakes.name as department','batches.year','modules.status','participants.name as created_by','modules.description','modules.updated_at','modules.subnote','modules.moduleid')
        ->join('module_wise_courses', 'modules.id', '=', 'module_wise_courses.module_id')
        ->join('batches', 'modules.batch_id', '=', 'batches.id')
        ->join('intakes', 'batches.intake_id', '=', 'intakes.id')
        ->join('participants', 'modules.created_by', '=', 'participants.id')
        ->where('modules.status','=','Board')
        ->where('modules.note_status','=', 1)
        ->where('module_wise_courses.flag','=', 2)
        ->where('module_wise_courses.subject_id','=', auth()->user()->id)
        ->orderBy('updated_at', 'DESC')
        ->distinct()
        ->paginate(15);
    
         // print_r($data['moduleList']);
         //exit;
    
    return view('pages.inbox.boardinbox', $data);
  
    }

    public function chairman($id)
    {
        
        $data['moduleList']=DB::table('modules')
        ->select('modules.id','modules.note_no','modules.name','modules.forwarded','modules.month','modules.file_name','modules.batch_id','batches.name as filename','module_wise_courses.remarks','intakes.name as department','batches.year','modules.status','participants.name as created_by','modules.description','modules.updated_at','modules.subnote','modules.moduleid','module_wise_courses.updated_at as inbox_time')
        ->join('module_wise_courses', 'modules.id', '=', 'module_wise_courses.module_id')
        ->join('batches', 'modules.batch_id', '=', 'batches.id')
        ->join('intakes', 'batches.intake_id', '=', 'intakes.id')
        ->join('participants', 'modules.created_by', '=', 'participants.id')
        ->whereNull('modules.status')
        ->where('batches.intake_id','=', $id)
        ->where('modules.note_status','=', 1)
        ->where('module_wise_courses.flag','=', 0)
        ->where('module_wise_courses.subject_id','=', auth()->user()->id)
        ->orderBy('updated_at', 'DESC')
        ->distinct()
        ->paginate(15);
        
return view('pages.inbox.index', $data);

  
    }

public function querystore(Request $request,$id)

{

    $query = new Queri();

    $query->query_question = $request->question;
    $query->note_id = $id;
    $query->send_from = auth()->user()->id;
    $query->send_to=$request->subject[0];

  
if($query->send_to=='')
{
   
    $query->send_to=$request->creator[0]; 
  

}  

    
    $query->save();

    return Redirect()->route('inbox.index')->with('success','send query.');

}



    public function EditNote($id)
    {   
        $data['module']=DB::table('modules')
        ->select('modules.id','modules.name','modules.month','modules.batch_id','batches.name as filename','participants.role','participants.desig_id as designame','modules.file_name','module_wise_courses.seq','module_wise_courses.flag','modules.status','modules.description','batches.old_file_name')
        ->join('module_wise_courses', 'modules.id', '=', 'module_wise_courses.module_id')
        ->join('batches', 'modules.batch_id', '=', 'batches.id')
        ->join('participants', 'module_wise_courses.subject_id', '=', 'participants.id')
        ->join('subjects', 'participants.desig_id', '=', 'subjects.id')
        ->where('modules.id','=', $id)
         ->where('module_wise_courses.subject_id','=', auth()->user()->id)
         ->where('module_wise_courses.flag','!=', 1)
        ->first();

        // print_r($data['module']);
        // exit;
       $prev_seq=$data['module']->seq-1;


       
        $data['prev_seq']=DB::table('module_wise_courses')
        ->select('module_wise_courses.subject_id','module_wise_courses.flag','participants.name')
        ->join('participants', 'module_wise_courses.subject_id', '=', 'participants.id')
        ->where('module_wise_courses.module_id','=', $id)
        ->where('module_wise_courses.seq','=', $prev_seq)
        ->first();


        $next_seq=$data['module']->seq+1;

           $data['next_seq']=DB::table('module_wise_courses')
           ->select('module_wise_courses.subject_id','module_wise_courses.flag','participants.name','module_wise_courses.seq','participants.email')
           ->join('participants', 'module_wise_courses.subject_id', '=', 'participants.id')
           ->where('module_wise_courses.module_id','=', $id)
           ->where('module_wise_courses.seq','=', $next_seq)
           ->first();

        // print_r($data['prev_seq']);
        // exit;   

        $data['last_seq'] = DB::table('module_wise_courses')
        ->where('module_wise_courses.module_id','=', $id)
        ->max('module_wise_courses.seq');
// print_r( $data['last_seq'] );
// exit;
          

       $data['remarklsit']=DB::table('module_wise_courses')
       ->select('module_wise_courses.subject_id','participants.name','module_wise_courses.remarks','module_wise_courses.flag','module_wise_courses.file_name as remark_file_name','module_wise_courses.file_path as remark_file_path')
       ->join('participants', 'module_wise_courses.subject_id', '=', 'participants.id')
       ->where('module_wise_courses.module_id','=', $id)
       ->get();


       $data['subjectList']=DB::table('participants')
       ->select('participants.id','participants.name','intakes.name as deptname' ,'subjects.name as designame') 
       ->join('subjects', 'participants.desig_id', '=', 'subjects.id') 
       ->join('intakes', 'participants.intake_id', '=', 'intakes.id') 
       ->where('participants.is_flow','=', 1)
       ->get();


       $data['sendquerylist']=DB::table('participants')
       ->select('participants.id','participants.name','intakes.name as deptname' ,'subjects.name as designame') 
       ->join('subjects', 'participants.desig_id', '=', 'subjects.id') 
       ->join('intakes', 'participants.intake_id', '=', 'intakes.id') 
       ->join('module_wise_courses', 'participants.id', '=', 'module_wise_courses.subject_id')
       ->where('module_wise_courses.module_id','=', $id)
       ->where('participants.is_flow','=', 1)
       ->distinct()
       ->get();


       $data['sendnotecreator']=DB::table('participants')
       ->select('participants.id','participants.name','intakes.name as deptname' ,'subjects.name as designame') 
       ->join('subjects', 'participants.desig_id', '=', 'subjects.id') 
       ->join('intakes', 'participants.intake_id', '=', 'intakes.id') 
       ->join('modules', 'participants.id', '=', 'modules.created_by')
       ->where('modules.id','=', $id)
       ->distinct()
       ->first();

    //  print_r($data['sendnotecreator']);
     // exit;

       $data['subjectListmd']=DB::table('participants')
       ->select('participants.id','participants.name','intakes.name as deptname' ,'subjects.name as designame') 
       ->join('subjects', 'participants.desig_id', '=', 'subjects.id') 
       ->join('intakes', 'participants.intake_id', '=', 'intakes.id') 
       ->where('participants.is_flow','=', 1)
       ->where('participants.is_mdlist','=', 1)
       ->get();


       $data['query']=DB::table('queries')
       ->select('id','note_id','query_question','query_answer','send_from','send_to')
       ->where('send_from','=', auth()->user()->id)
       ->where('note_id','=', $id)
       ->first();
   
      

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

 //dd($data['countquery']);
//exit;
return view('pages.inbox.edit', $data);

    }
    public function update(Request $request, $id)
    {
        switch ($request->input('action')) {

            case 'approvedbychairman':

                $seq=$request->invisible;

                $module = ModuleWiseCourse::where('module_id','=',$id)
                ->where('subject_id','=',auth()->user()->id)
                ->where('module_wise_courses.flag','!=', 1)
                ->first();

                        
                $module->flag = 1;
                if($request->remarks =='')
                {
                    $module->remarks ='Approved by Chairman';
                }
                else
                {$module->remarks = $request->remarks;}
        

        $modulestatus = Module::find($id);
        $modulestatus->forwarded='Y';


                $md_id=participant::select('id')
                ->where('desig_id', '7')->first();

                    $subject = new ModuleWiseCourse();
                    $subject->module_id = $id;                            
                    $subject->flag = 0;
                    $subject->seq=$seq+1;
                    $subject->subject_id = $md_id->id;
                    $subject->save();

        $module->save();
        $modulestatus->save();            

        return Redirect()->route('inbox.index')->with('success','File is Approved by Chairman.');
        break;


            case 'Forward':  
                $data['module']=DB::table('modules')
                ->select('modules.id','modules.name','module_wise_courses.seq','module_wise_courses.flag')
                ->join('module_wise_courses', 'modules.id', '=', 'module_wise_courses.module_id')
                ->where('modules.id','=', $id)
                 ->where('module_wise_courses.subject_id','=', auth()->user()->id)
                 ->where('module_wise_courses.flag','!=', 1)
                ->first();
        
               
               $next_seq=$data['module']->seq+1;

               $data['next_seq']=DB::table('module_wise_courses')
               ->select('module_wise_courses.subject_id','module_wise_courses.flag','participants.name','module_wise_courses.seq'
               ,'participants.email')
               ->join('participants', 'module_wise_courses.subject_id', '=', 'participants.id')
               ->where('module_wise_courses.module_id','=', $id)
               ->where('module_wise_courses.seq','=', $next_seq)
               ->first();

               
               $nextseq = ModuleWiseCourse::where('module_id','=',$id)
               ->where('module_wise_courses.seq','=', $next_seq)
               ->first();
          if($nextseq->flag==null)
          {
            $nextseq->flag = 0;
          }

              

               $date = Carbon::now();
               $nextseq->updated_at=$date; 

                $module = ModuleWiseCourse::where('module_id','=',$id)
                ->where('subject_id','=',auth()->user()->id)
                ->where('module_wise_courses.flag','!=', 1)
                ->first();
                
                
    

        $module->flag = 1;
        $module->remarks = $request->remarks;

        $modulestatus = Module::find($id);
        $modulestatus->forwarded='Y';

        if($request->file('file')!='')

        {
            $request->validate(['file' => 'required|mimes:jpg,jpeg|max:2048']);
            if ($request->file()) {

                $fileName = time() . '_' . $request->file->getClientOriginalName();
                $filePath = $request->file('file')->move(public_path('images'), $fileName);
                $module->file_name = time() . '_' . $request->file->getClientOriginalName();
                $module->file_path = $filePath;
            }
        }    



        $nextseq->save();
        $module->save();
        $modulestatus->save();

        return Redirect()->route('inbox.index')->with('success','File is Forwarded.');

        break;

// if($data['next_seq']->email!='')
// {
//     return Redirect()-> route('send.mail', $data['next_seq']->email);
// }
// else
// { return Redirect()->route('inbox.index')->with('success','File is Forwarded.');}
    
          
    
            case 'Approve':
                $module = ModuleWiseCourse::where('module_id','=',$id)
                ->where('subject_id','=',auth()->user()->id)
                ->where('module_wise_courses.flag','!=', 1)
                ->first();
                $modulestatus = Module::find($id);
                $modulestatus->status='Approved';
                $module->flag = 1;
                $module->remarks = $request->remarks;
                $module->save();
                $modulestatus->save();
                return Redirect()->route('inbox.index')->with('success','Approved.');
                // Preview model
                break;
            case 'send':
               

                    $module = ModuleWiseCourse::where('module_id','=',$id)
                    ->where('subject_id','=',auth()->user()->id)
                    ->where('module_wise_courses.flag','!=', 1)
                    ->first();
                    $modulestatus = Module::find($id);
                    $modulestatus->status='Board';
                    $module->flag = 1;
                    $module->remarks = $request->remarks;
                    $module->save();
                    $modulestatus->save();



                    $seq=$request->invisible;
                           
                    for ($i = 0; $i < sizeof($request->subject); $i++)
                    {
                       $subject = new ModuleWiseCourse();
                       if( $request->subject[$i]!='')
                       {
                        $subject->module_id = $id;                            
                        $seq=$seq+1;
                        $subject->flag = 0;
                        $subject->seq=$seq;
                        $subject->subject_id = $request->subject[$i];
                        $subject->save();
                      }

                    

                    }

                    $baord_id=participant::select('id')
                ->where('role', '5')->first();

                    $subject = new ModuleWiseCourse();
                    $subject->module_id = $id;                            
                    $subject->flag = 2;
                    $subject->seq=$seq+1;
                    $subject->subject_id = $baord_id->id;
                    $subject->save();





                    return Redirect()->route('inbox.index')->with('success','send to Board.');
                    // Preview model
                    break;

            case 'Reject':
                $module = ModuleWiseCourse::where('module_id','=',$id)
                ->where('subject_id','=',auth()->user()->id)
                ->where('module_wise_courses.flag','!=', 1)
                ->first();
                $modulestatus = Module::find($id);
                $modulestatus->status='Rejected';
                $module->flag = 1;
                $module->remarks = $request->remarks;
                $module->save();
                $modulestatus->save();
                return Redirect()->route('inbox.index')->with('success','Rejected.');
                // Redirect to advanced edit
                break;

             case 'finish':

                    $modulestatus = Module::find($id);
                    $modulestatus->paid='Y';
                    $module = ModuleWiseCourse::where('module_id','=',$id)
                    ->where('subject_id','=',auth()->user()->id)
                    ->where('module_wise_courses.flag','!=', 1)
                    ->first();                 
                    $module->flag = 1;
                    $module->remarks = $request->remarks;
                    $module->save();
                    $modulestatus->save();
               
                    return Redirect()->route('inbox.index')->with('success','Note has been clearanced.');
                    // Redirect to advanced edit
                    break;
            case 'ForwardTo':
               
                if( $request->subject[0]!='')
                { 
                $module = ModuleWiseCourse::where('module_id','=',$id)
                ->where('subject_id','=',auth()->user()->id)
                ->where('module_wise_courses.flag','!=', 1)
                ->first();
                $modulestatus = Module::find($id);
                $modulestatus->forwarded='Y';
        if(auth()->user()->role==5)
        {

            $modulestatus->status=null;
        }

                $module->flag = 1;
                $module->remarks = $request->remarks;
                $module->save();
                $modulestatus->save();

                        if(auth()->user()->role=='4')
                        { 
                            
                            $subject = new ModuleWiseCourse();
                            $subject->module_id = $id;
                            $subject->subject_id=$request->subject[0];
                            $seq=$request->invisible;
                            $seq=$seq+1;
                            $subject->seq=$seq; 
                            $subject->flag = 0;
                            $subject->save();
                    
                        }
            
                    else{
                        
                        // echo $seq;
                        // exit;
                                $seq=$request->invisible;
                                for ($i = 0; $i < sizeof($request->subject); $i++)
                                {
                                $subject = new ModuleWiseCourse();
                                $subject->module_id = $id;
                                $subject->flag = 0;
                                $seq=$seq+1;
                                $subject->seq=$seq;
                                $subject->subject_id = $request->subject[$i];
                                $subject->save();}
                     }

                return Redirect()->route('inbox.index')->with('success','Forwarded.');
                break;
           }  
                return Redirect()->route('inbox.index')->with('error','please select person to forward.');
                break;

                case 'approveforward':

                
                    $module = ModuleWiseCourse::where('module_id','=',$id)
                    ->where('subject_id','=',auth()->user()->id)
                    ->where('module_wise_courses.flag','!=', 1)
                    ->first();
                    $modulestatus = Module::find($id);
                    $modulestatus->status='Approved';
                    $modulestatus->forwarded='Y';                  
                    $module->flag = 1;
                    $module->remarks = $request->remarks;
                    $module->save();
                    $modulestatus->save();
    
                 
                    // echo $seq;
                    // exit;
                            $seq=$request->invisible;
                           
                            for ($i = 0; $i < sizeof($request->subject); $i++)
                            {
                               $subject = new ModuleWiseCourse();
                               if( $request->subject[$i]!='')
                               {
                                $subject->module_id = $id;                            
                                $seq=$seq+1;
                                $subject->flag = 0;
                                $subject->seq=$seq;
                                $subject->subject_id = $request->subject[$i];
                                $subject->save();}
                            
    
                            }
    
                    
                    return Redirect()->route('inbox.index')->with('success','Approved & Forwarded.');
                    break;
    

        }

     
    }

    public function querylist(){

    $data['querylist']=DB::table('queries')
    ->select('queries.id','queries.query_question','queries.query_answer','queries.note_id','queries.query_status','participants.name as send_from','users.name as sendto_person','queries.send_to','queries.created_at','modules.note_no','modules.name','intakes.name as department','batches.year as file_no','batches.name as file_name' ,'queries.send_from as sendpersonid')
    ->join('participants', 'queries.send_from', '=', 'participants.id')
    ->join('users', 'queries.send_to', '=', 'users.id')
      ->join('modules', 'queries.note_id', '=', 'modules.id')
    ->join('batches', 'modules.batch_id', '=', 'batches.id')
    ->join('intakes', 'participants.intake_id', '=', 'intakes.id')
    ->whereNull('queries.query_status')
    ->Where('queries.send_to','=', auth()->user()->id)
    ->orderBy('queries.created_at', 'DESC')
    ->paginate(15);

    return view('pages.inbox.querylist',$data);
    }   
    
    public function replyquerylist(){

        $data['querylist']=DB::table('queries')
        ->select('queries.id','queries.query_question','queries.query_answer','queries.note_id','queries.query_status','participants.name as send_from','users.name as sendto_person','queries.send_to','queries.created_at','modules.note_no','modules.name','intakes.name as department','batches.year as file_no','batches.name as file_name','queries.send_from as sendpersonid' )
        ->join('participants', 'queries.send_from', '=', 'participants.id')
        ->join('users', 'queries.send_to', '=', 'users.id')
        ->join('modules', 'queries.note_id', '=', 'modules.id')
        ->join('batches', 'modules.batch_id', '=', 'batches.id')
        ->join('intakes', 'participants.intake_id', '=', 'intakes.id')
        ->wherenotNull('queries.query_status')
        ->Where('queries.reply_to','=', auth()->user()->id)
        ->orderBy('queries.created_at', 'DESC')
        ->paginate(15);

        DB::table('queries')->Where('queries.reply_to','=', auth()->user()->id)->update(array('isseen' => 1));
    
// print_r( $data['querylist']);
//  exit;

        return view('pages.inbox.replyquerylist',$data);
        }  


    
    public function queryupdate(Request $request, $id)
    {
        
        $query = Queri::find($id);
        $query->query_answer = $request->answer;
        $query->query_status = 1;
        $query->reply_to =  $request->replyto;
        $query->save();
        return back()->with('success','query has been replied.');
       
        //
    }

}
